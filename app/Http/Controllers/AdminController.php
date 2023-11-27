<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class AdminController extends Controller
{
    use  ResponseTrait;
    public function verify(User $user)
    {
        try {
            $user->update([
                'verify' => 1,
            ]);

            return $this->successResponse($user, 'User successfully verified.');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
