<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model
{
    use HasFactory;
    use SoftDeletes; // Use the trait

    protected $fillable = ['employee_id','month' ,'year','absence','penalty','housing','status'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public static function reason(){
        return ['خصم سكن', 'خصم غياب', 'خصم جزاءات'];
    }
}
