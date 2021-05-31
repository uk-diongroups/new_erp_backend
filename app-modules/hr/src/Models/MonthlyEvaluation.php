<?php

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonthlyEvaluation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_evaluation';

    protected $guarded = ['id','created_at','deleted_at'];
}
