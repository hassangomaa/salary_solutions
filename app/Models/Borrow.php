<?php

namespace App\Models;

use App\Models\Safe\Safe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use HasFactory;
    use SoftDeletes;

//    protected $fillable = [
//        'employee_id',
//        'month',
//        'amount',
//        'statement',
//        'safe_id'
//    ];

    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function safe()
    {
        return $this->belongsTo(Safe::class, 'safe_id');
    }

    public function transactionLog()
    {
        return $this->belongsTo(TransactionLog::class, 'transaction_logs_id');
    }

    public function safeTransaction()
    {
        return $this->belongsTo(SafeTransactions::class, 'safe_transactions_id');
    }

}
