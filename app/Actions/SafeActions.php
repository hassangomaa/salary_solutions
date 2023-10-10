<?php

namespace App\Actions;

use App\Models\Safe\Safe;
use App\Models\Safe\SafeTransactions;
use SebastianBergmann\Type\TrueType;

class SafeActions {


    public $safe;
    public $reason_id;

    public $ammount;

    public $reasonable_type;
    public $reasonable_id;

    public function __construct(
        $safe_id,
        $reason_id,
        $ammount,
        $reasonable_type,
        $reasonable_id

    ){
        $this->safe=Safe::find($safe_id);
        $this->reason_id=$reason_id;
        $this->ammount=$ammount;
        $this->$reason_id=$reason_id;
        $this->reasonable_type=$reasonable_type;
        $this->reasonable_id=$reasonable_id;
    }


    public function deposit(){
        $value=$this->safe->value;
        $this->safe->value=($value+$this->ammount);
        $this->safe->save();

        return  self::transactions($this->ammount);
         $this->safe;

    }

    public function withdraw(){
        $value=$this->safe->value;

        $this->safe->value=($value-$this->ammount);
        $this->safe->save();
        return  self::transactions(-$this->ammount);
        return $this->safe;
    }

    public function transfer($safe_to){
        $value=$this->safe->value;
        $this->safe->value=($value-$this->ammount);
        $this->safe->save();

        $value_to=$this->safe->value;
        $safe_to->value=($value_to+$this->ammount);
        $safe_to->save();
        // $safe=Safe::find($safe_to);
          self::transactions(-$this->ammount);
         $this->safe;
    }
    public function transactions($ammount){
        $reason=$this->reason_id;
       return SafeTransactions::create([
            'safe_id'=>$this->safe->id,
            'value'=>$ammount,
            'reasonable_type'=>$this->reasonable_type,
            'reasonable_id'=>$this->reasonable_id,
            'details'=>$reason
        ]);
    }

}
