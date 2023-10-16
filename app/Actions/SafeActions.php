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
        $this->safe->deposite=($this->ammount);
        $this->safe->withdraw=(0);

        $this->safe->save();
        return $this->transactions($this->safe->value, $this->ammount, 0);
//        return  self::transactions($this->safe->value,$this->ammount,0);
//         $this->safe;

    }

    public function withdraw(){
        $value=$this->safe->value;

        $this->safe->value=($value - $this->ammount);
        $this->safe->deposite=(0);
        $this->safe->withdraw=($this->ammount);

        $this->safe->save();
        return $this->transactions($this->safe->value, 0, $this->ammount);

//        return  self::transactions($this->safe->value,0,$this->ammount);
//         $this->safe;
//        return $this->safe;
    }

//    public function transfer($safe_to){
//        $value=$this->safe->value;
//        $this->safe->value=($value-$this->ammount);
//        $this->safe->save();
//
//        $value_to=$this->safe->value;
//        $safe_to->value=($value_to+$this->ammount);
//        $safe_to->save();
//
//        return $this->transactions(-$this->ammount);
//
////        // $safe=Safe::find($safe_to);
////        self::transactions(-$this->ammount);
////         $this->safe;
//    }

    public function transfer($safe_to) {
        $value = $this->safe->value;
        $this->safe->value = $value - $this->ammount;
        $this->safe->withdraw = $this->ammount; // Update the withdraw column
        $this->safe->save();

        $value_to = $safe_to->value;
        $safe_to->value = $value_to + $this->ammount;
        $safe_to->deposite = $this->ammount; // Update the deposit column
        $safe_to->save();

        // Calculate the new total amount in transaction
        $new_total_amount = $this->safe->value;

        // Create a transaction for the source safe
        $this->transactions(-$this->ammount, 0, $this->ammount);

        // Create a transaction for the destination safe
        $safe_to->transactions($this->ammount, $this->ammount, 0);

        return [
            'new_total_amount' => $new_total_amount,
            'deposited' => $this->ammount,
            'withdrawn' => 0,
        ];
    }

    public function transactions($ammount, $deposit=0, $withdraw=0){
        $reason=$this->reason_id;
        $this->safe->value;
       $trans = SafeTransactions::create([
            'safe_id'=>$this->safe->id,
            'value'=>$ammount,
            'deposite'=>$deposit,
            'withdraw'=>$withdraw,
            'reasonable_type'=>$this->reasonable_type,
            'reasonable_id'=>$this->reasonable_id,
            'details'=>$reason
        ]);
       $trans->save();
        return $trans;
    }

}
