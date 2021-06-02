<?php

namespace Modules\Monthlyevaluation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sub_Categories extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'monthly_evaluation_categories';

    protected $fillable = ['monthly_evaluation_id', 'task'];
    
}
