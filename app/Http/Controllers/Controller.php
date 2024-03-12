<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function sendResponse($result,$message)
    {
        $response = [
            'success'=>true,
            'data'=>$result,
            'message'=>$message
        ]    ;
        return response()->json($response,200);
    }
    public function sendError($error,$errorMessage = [],$code = 404){
        $response = [
            'success'=>false,
            'message'=>$error
        ];
        if(!empty($errorMessage))
            $response['data'] = $errorMessage;
        return response()->json($response,$code);
    }
}
