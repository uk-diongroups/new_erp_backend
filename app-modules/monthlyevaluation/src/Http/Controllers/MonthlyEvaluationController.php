<?php

namespace Modules\Monthlyevaluation\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Modules\Employee\Models\Employee;
use Modules\Monthlyevaluation\Models\MonthlyEvaluation;

class MonthlyEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MonthlyEvaluation::all();
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
    public function store(Request $request) :JsonResponse//create KRA/KPI
    {
        
        $data = $request->all();
        try {
            $created = MonthlyEvaluation::create($data);
            if($created)
                return formatAsJson(true,'Appraisal created', $data, 200);
        } catch (\Throwable $th) {
            return $th;
            return formatAsJson(false,'Failed to create', "", 400);
        }

    }

    public function getEmployeeKPI(Request $request) :JsonResponse
    {
        //check employee is active and exists
        $emp_details = Employee::where('id', (int) $request->employee_id)->where('status',1)->first();
        if(checkNotEmpty($emp_details)){
            $eval = MonthlyEvaluation::where('employee_id',(int)$request->employee_id)->get();
            return formatAsJson(true,"KPIs for this employee this month", $eval, 200);
        }
        return formatAsJson(false,'KPIs not set yet for this month', $eval, 200);

    }

    

    public function createSubCategory(Request $request):JsonResponse  
    {
        $data = $request->all();



        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
