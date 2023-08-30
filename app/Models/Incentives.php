<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Incentives extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['employee_id', 'amount', 'reason'];


    public static function reason(){
        return  ['حافز', 'مكافاءه', 'انتظام', 'عيديه'];
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
