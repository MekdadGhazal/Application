<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

trait ResponseTrait
{
    public function jsonResponse($data, $message, $status){
        return response()->json([
            'data'      => $data,
            'message'   => $message,
            'status'    => $status
        ]);
    }

    public function successResponse($data, $message = null){
        return $this->jsonResponse($data, $message, Response::HTTP_OK);
    }

    public function modifyResponse($data, $message = null){
        return $this->jsonResponse($data, $message, Response::HTTP_CREATED);
    }

    public function invalidResponse($data, $message = null){
        return $this->jsonResponse($data, $message, Response::HTTP_BAD_REQUEST);
    }

    public function errorResponse($data = null, $message = 'NOT Found.'){
        return $this->jsonResponse($data, $message, Response::HTTP_NOT_FOUND);
    }

    public function unAuthorizedResponse($data = null, $message = 'Error - Unauthorized.'){
        return $this->jsonResponse($data, $message, Response::HTTP_UNAUTHORIZED);
    }

    public function unprocessableResponse($data = null, $message = 'An error occurred while checking the Request.'){
        return $this->jsonResponse($data, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function serveErrorResponse($data = null, $message = 'An error occurred while fetching the Request.'){
        return $this->jsonResponse($data, $message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

}
