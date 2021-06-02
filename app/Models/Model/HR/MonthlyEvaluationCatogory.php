<?php

namespace App\Models\Model\HR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyEvaluationCatogory extends Model
{
    use HasFactory;
    protected $table = "monthly_evaluation_categorys";
    protected $fillable = ['monthly_evaluation_id','task'];
}
