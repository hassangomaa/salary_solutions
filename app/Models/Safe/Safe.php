<?php

namespace App\Models\Safe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safe extends Model
{
    use HasFactory;
    protected $table="safes";
    protected $fillable=[
        'value',
        'name',
        'type',
    ];



    public function transactions(){
        return $this->hasMany(SafeTransactions::class,'safe_id');
    }


}
