<?php

namespace App\Models\Safe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeTransactions extends Model
{
    use HasFactory;



    public const PAY_SALARIES=1;
    public const BORROWING=2;

    protected $table="safe_transactions";
    protected $fillable=[
        'safe_id',
        'value',
        'reasonable_type',
        'reasonable_id',
        'details'
    ];


}
