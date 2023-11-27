<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ResponseTrait;

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:8',
                'phone' => 'required|string|between:2,15',
                'city' => 'required|string|between:2,50',
                'card' => 'required|string|between:10,100',
                'bank' => 'required|string|between:2,50',
                'location' => 'required|string',
                'image' => 'nullable|image', // 'image' is the field name for the user's image
                'located' => 'nullable|image', // 'located' is the field name for the location image
                'customer' => 'nullable|boolean',
                'main' => 'required_if:customer,1|exists:categories,id',
                'part' => 'required_if:customer,1|exists:part,cat_id',
            ]);

            if ($validator->fails()) {
                return $this->invalidResponse($validator->errors());
            }

            $userData = $validator->validated();
            $userData['password'] = bcrypt($request->password);

            $customer = User::create($userData);

            if ($request->customer == 1) {
                $customerValidator = Validator::make($request->all(), [
                    'main' => 'required|exists:categories,id',
                    'part' => 'required|exists:part,cat_id',
                ]);

                if ($customerValidator->fails()) {
                    return $this->invalidResponse($customerValidator->errors());
                }

                Customer::create([
                    'user_id' => $customer->id,
                    'main' => $request->main,
                    'part' => $request->part,
                ]);
            }

            if ($request->hasFile('image')) {
                $personal_image = $this->upload($request, 'image', 'image', $customer->id);
            }

            if ($request->hasFile('located')) {
                $loc_image = $this->upload($request, 'located', 'image', $customer->id);
            }

            return $this->successResponse($customer, 'User successfully registered.');

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

    public function  loginUser($request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return $this->notValidResponse($validator->errors());
        }
        if (! $token = auth()->attempt($validator->validated())) {
            return $this->unAuthorizedResponse();
        }
        return $this->createNewToken($token);
    }


    public function upload($request, $inputFileName, $optionFileSystem, $storeIn = null): mixed
    {
        $file = $request->file($inputFileName)->getClientOriginalName();
        $path = $request->file($inputFileName)->storeAs($storeIn ,$file, $optionFileSystem);
        return $path;
    }


    protected function createNewToken($token){
        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 120,
            'user' => auth()->user()
        ]);
    }
}
