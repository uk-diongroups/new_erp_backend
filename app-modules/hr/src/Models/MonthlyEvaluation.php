<?php

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyEvaluation extends Model
{
    use HasFactory;

    protected $table = 'monthly_evaluation';

    protected $guarded = ['id','created_at'];
}
