<?php

namespace Modules\Employee\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'tbl_employees';
    protected $guarded = ['id'];
}
