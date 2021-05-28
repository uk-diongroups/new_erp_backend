<?php

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
       
   	/**
   	  * declaring table
   	*/

       public $table = 'tbl_departments';

       /**
        * The attributes that should be fillable for arrays.
        *
        * @var array
        */
   
       protected $fillable = [
           'title',
           'status',
       ];
   
   
       /**
        * Indicates if the model should be timestamped.
        *
        * @var bool
        */
}
