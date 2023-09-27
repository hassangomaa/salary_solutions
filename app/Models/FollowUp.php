<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowUp extends Model
{
    use HasFactory,SoftDeletes;

    public const DONE=1;
    public const USE=2;

    protected $fillable = [
        'employee_id',
        'month',
        'year',
        'attended_days',
        'daily_wages_earned',
        'extra_hours',
        'total_extras',
        'borrows',
        'incentives',
        'deductions',
        'net_salary',
        'status'
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
