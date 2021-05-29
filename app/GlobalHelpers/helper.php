<?php

if(!function_exists('checkIfNotEmpty')){
    function checkIfNotEmpty($item):bool
    {
        return (!empty($item) && !is_null($item));
    }
}

if(!function_exists('formatAsJson')){
    function formatAsJson($status=NULL, $message=NULL, $data=NULL, $statusCode=NULL){
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}