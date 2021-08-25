<?php

namespace Modules\Employee\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\Hr\Models\Department;
use Modules\Hr\Models\Designation;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles ;

    protected $table = 'tbl_employees';
    protected $guarded = ['id'];
    protected $hidden = ['gross'];
   // protected $guard_name = 'sanctum';

   const password = 'password';
   const remember_token = 'remember_token';

   protected static function boot(){
        parent::boot();
        self::creating(function ($model){
            $r= Str::random(10);
            $model->{self::password} = Hash::make($model['password']);
            $model->{self::remember_token} = $r;
        });
    }
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }

    public function routeNotificationForSlack($notification)
    {
       // return config('app.slack_webhook');
    }
}
