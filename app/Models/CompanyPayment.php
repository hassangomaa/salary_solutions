<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Safe\Safe;

class CompanyPayment extends Model
{
    use HasFactory,SoftDeletes;

    //company_payments
    //table company_payments
    protected $table = 'company_payments';

    private static $paymentTypes =  ['deposit', 'withdrawal'];

//    protected $fillable = ['amount', 'statement','type','company_id'];
    protected $guarded = [];
    public function company(){
        return $this->belongsTo(Safe::class,'company_id');
    }

    public static function paymentType():array{
        return self::$paymentTypes;
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

