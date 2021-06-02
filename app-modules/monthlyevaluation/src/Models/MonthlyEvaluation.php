<?php

namespace Modules\Monthlyevaluation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyEvaluation extends Model //KPI MODEL
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_evaluations';

    protected $fillable = ['user_id','employee_id','key_result_area','month_of_evaluation'];
    
    public $timestamps = ['created_at','deleted_at'];
}

