<?php

namespace Modules\Employee\Models;

use Laravel\Sanctum\HasApiTokens;
use Modules\Hr\Models\Department;
use Modules\Hr\Models\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasApiTokens, HasFactory, Notifiable ;

    protected $table = 'tbl_employees';
    protected $guarded = ['id'];

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
        return config('app.slack_webhook');
    }
}
