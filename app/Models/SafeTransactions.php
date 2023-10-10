<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeTransactions extends Model
{
    use HasFactory;

    protected $table="safe_transactions";
//    protected $fillable=[
//        'safe_id',
//        'value',
//        'reasonable_type',
//        'reasonable_id',
//        'details',
//        'created_at'
//    ];

    //guraded
    protected $guarded = [];

}
