<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'attended_days',
        'daily_wages_earned',
        'extra_hours',
        'total_extras',
        'borrows',
        'incentives',
        'deductions',
        'net_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function incentive()
    {
        return $this->hasMany(Incentives::class,'employee_id','employee_id');
    }


}
