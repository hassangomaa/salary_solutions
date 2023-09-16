<?php

namespace App\Models\Borrowing;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employeeBorrowing extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'amount',
        'date_id',
        'percentage'
    ];


    public function date(){
        return $this->belongsTo(borrowing_dates::class,'date_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
