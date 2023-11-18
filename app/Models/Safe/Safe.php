<?php

namespace App\Models\Safe;

use App\Models\Borrow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Safe extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="safes";
    protected $fillable=[
        'value',
        'name',
        'type',
        'deposit',
        'withdraw',
        'deleted_at',
    ];



    public function transactions(){
        return $this->hasMany(SafeTransactions::class,'safe_id');
    }
    public function borrows()
    {
        return $this->hasMany(Borrow::class, 'safe_id');
    }


}
