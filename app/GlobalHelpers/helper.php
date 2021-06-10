<?php

use Modules\Employee\Models\Employee;

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

if(!function_exists('checkValidEmployee')){
    function checkValidEmployee($emp_id){
        return $data = Employee::where('id', (int) $emp_id)->where('status',1)->first();
        //return (!empty($emp_id) && !is_null($emp_id)) ? 'true' : 'false';
        if(empty($data)){
            return false;
        }
        return true;
    }
}

if(!function_exists('checkNotEmpty')){
    function checkNotEmpty($data){
        return (empty($data) && is_null($data)) ? false : true;
    }
}

if(!function_exists('getLoggedInEmployee')){
    function getLoggedInEmployee(){
        $data = getFullName();
        return $data;
    }
}

if(!function_exists('getFullName')){
    function getFullName(){
        $user = Auth::guard('sanctum')->user();
        return $user->first_name.' '.$user->last_name; 
    }
}



