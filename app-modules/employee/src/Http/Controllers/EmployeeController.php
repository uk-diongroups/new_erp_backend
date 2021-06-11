<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Employee\Models\Employee;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    public function login(Request $request)
    {
         $LI = $request->login_info;
         $employee = Employee::where('email', $LI)->where('status',1)->first();
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emps = Employee::get()->load(['departments','designation']);
        if(count($emps) > 1){
            $fnArray = array();
                
            foreach($emps as $key => $value){
               unset($value->gross);
               unset($value->leaving_date);
               unset($value->designation_id);
               unset($value->shift_id);
               unset($value->employee_type);
               unset($value->allowed_leave);
               unset($value->salary_type);
               unset($value->monthly_reimbursable);
               unset($value->monthly_salary);
               unset($value->basic_salary);
               unset($value->accomodation_allowance);
               unset($value->percentage_to_achived);
               unset($value->house_rent_allowance);
               unset($value->transportation_allowance);
               unset($value->telephone_allowance);
               unset($value->leave_allowance);
               unset($value->others_allowance);
               unset($value->monthly_target);
               unset($value->smartsaver_date);
               unset($value->smartsaver_percentage);
               unset($value->account_number);
               unset($value->beneficiary_bank);
               unset($value->overtime_1);
               unset($value->overtime_2);
               unset($value->overtime_3);
               unset($value->confirmed_by);
               unset($value->status);
               unset($value->cover);
               unset($value->avatar);
               unset($value->remember_token);
               unset($value->create_by);
               unset($value->updated_by);
               unset($value->date_updated);
               unset($value->create_ip);
               unset($value->login_ip);
               unset($value->last_login_time);
               unset($value->created_at);
               unset($value->updated_at);
              
              array_push($fnArray, $value);
        }
            return formatAsJson(true, 'List of all employees', $emps, 200);
        }
            
        return formatAsJson(false, 'No employee found', $emps, 200);
    }

    public function bulkSaveEmployees() : Response
    {
        $response = Http::get('https://ukdiononline.com/api/allLMSemployees/rw');
        if($response->successful()){
            $res_body = $response['data'];
            $fn = [];
            foreach ($res_body as $key => $value) {
               //Employee::create();
               DB::table('tbl_employees')->insert([$value]);
            }
            if(count(Employee::all()) > 1 ){
                return response()->json([
                    'status' => true,
                    'message'=> "Employees created"
                ]);
            }else{
                return response()->json([
                    'status' => 'failed',
                    'message'=> "Operation failed to create"
                ]);
            }

            //return $res_body;
        }else{
            return "an error occured";
        }

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
        $data = $request->json()->all();
        $created = Employee::create($data);
        if($created)
            return formatAsJson(true, 'employee created', $data,200);
        return formatAsJson(false, 'Failed to create','',400);
        
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