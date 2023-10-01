<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    const HTTP_DEFAULT_ERROR_CODE = 400;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse( $message, $result = null, $commondata = null)
    {
        $response = [
            'common_data' => $commondata,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = null, $code = self::HTTP_DEFAULT_ERROR_CODE)
    {
        $response = [
            'message' => $error,
            'data' => $errorMessages,
        ];


        return response()->json($response, $code);
    }
}
