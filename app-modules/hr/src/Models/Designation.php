<?php

namespace Modules\Hr\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
  

   	public $table = 'tbl_designations';


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
    public $timestamps = false;
}
