<?php

namespace App\Models;

use App\Models\Safe\Safe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyPayment extends Model
{
    use HasFactory,SoftDeletes;

    private static $paymentTypes =  ['deposit', 'withdrawal'];

    protected $fillable = ['amount', 'statement','type','company_id'];

    public function company(){
        return $this->belongsTo(Safe::class,'company_id');
    }

    public static function paymentType():array{
        return self::$paymentTypes;
    }
}

