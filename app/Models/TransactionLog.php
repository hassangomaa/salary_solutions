<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionLog extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'company_id',
        'amount',
        'type_ar',
        'type_en',
        'statement_en',
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }
}
