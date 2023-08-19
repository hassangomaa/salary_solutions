<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commission extends Model
{
    use HasFactory;
    use SoftDeletes; // Use the trait

    protected $fillable = ['employee_id', 'amount', 'reason'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
