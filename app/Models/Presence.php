<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use HasFactory;
    use SoftDeletes; // Use the trait

    protected $fillable = ['emp_id', 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
