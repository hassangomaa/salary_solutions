<?php

namespace App\Models\Borrowing;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrowing_dates extends Model
{
    use HasFactory;
    // protected $table=
    protected $fillable=[
        'month',
        'year',

    ];


    public function employeeBorrowing(){
        return $this->hasMany(employeeBorrowing::class,'date_id');
    }

}
