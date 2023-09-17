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

    protected $table="safe_transactions";
    protected $fillable=[
        'safe_id',
        'value',
        'reasonable_type',
        'reasonable_id',
        'details'
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

}
