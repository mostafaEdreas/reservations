<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected function successResponse($data = [],$message = 'success' , $status = 200 ,$additions = []){
        $response = array_merge([
            'data' => $data,
            'status' => $status,
            'message' => $message,
        ], $additions);
    
        return response()->json($response);
    }
}
