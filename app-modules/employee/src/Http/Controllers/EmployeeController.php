<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Employee\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::all();

        return response()->json([
            'status'=> true,
            'data' => $data
        ]);
    }

    public function login(Request $request)
    {
        $LI = $request->login_info;
        $employee = Employee::where('email', $LI)->first();
        if ($employee) {
            if ($this->attemptLogin($employee, $request)) {   //Attempt to log in user/employee
                $accessToken = $employee->createToken('authToken',['server:update'])->plainTextToken;
                
                return response()->json([
                    "status" => true,
                    "messge"=> "log in successful",
                    "data" => $employee,
                    "access_token" => $accessToken,
                    "token_type" => "Bearer"
                ]);
            }
            //return $this->sendFailedLoginResponse($request);
            return "Access denied";
        }
            //return $this->UserNotFoundResponse($request);
            return "User not found";
    }
    
    public function attemptLogin(Object $employee, Object  $request)
    {
        return (Hash::check($request->password, $employee->password)) ? true : false;
    }

    public function logout(){
        $user= Auth::guard('sanctum')->user();
        try {
            $killedToken=$user->tokens()->delete();
            if($killedToken){
                return response()->json(['status'=> true,'message'=> 'Logout successful'],200);
            }
        } catch (Exception $e) {
            return response()->json(['status'=> false,'message'=> 'Oops! something went wrong please try again'],400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function forgot_password(Request $request)
    {

        $input = $request->all();
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                    $message->subject($this->getEmailSubject());
                });
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                    case Password::INVALID_USER:
                        return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
                }
            } catch (\Swift_TransportException $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            } catch (Exception $ex) {
                $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
            }
        }
        return \Response::json($arr);
    }
}