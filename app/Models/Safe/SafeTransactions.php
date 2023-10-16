<?php

namespace App\Models\Safe;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafeTransactions extends Model
{
    use HasFactory;



    public const PAY_SALARIES=1;
    public const BORROWING=2;
    public const PAYMENT=3;

    protected $table="safe_transactions";
    protected $fillable=[
        'safe_id',
        'value',
        'reasonable_type',
        'reasonable_id',
        'details',
        'created_at',
        'updated_at',
        'deposite',
        'withdraw',
    ];

    public function user(){
        return $this->belongsTo(User::class,'reasonable_id');
    }

    public static function details($id){
        switch ($id){
            case self::BORROWING:
                return "Borrwing To employee";
                break;
            case self::PAY_SALARIES:
                return "Pay Salaries";
                break;
            default:
            return null;
        }
    }

    public function safe(){
        return $this->belongsTo(Safe::class,'safe_id');
    }

}
