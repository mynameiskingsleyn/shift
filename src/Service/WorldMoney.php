<?php

namespace App\Service;

abstract class WorldMoney
{
    protected $cost;
    protected $amount;
    protected $balance;
    protected $error;
    protected $success;
    protected $message;
    protected $validated;
    protected $status;
    public function __construct($cost, $amount)
    {
        $this->cost = $cost;
        $this->amount=$amount;
        $this->error=false;
        $this->success=true;
        $this->message='';
        $this->validated = true;
    }
    final protected function squize($num, $div, $denom)
    {
        $rem = $num % $div;
        $amount = floor($num/$div);
        $this->bank[$denom]=(int)$amount;
        return $rem;
    }
    final public function tenderChange($num)
    {
        $pre = 'set';
        $rem = $num * 100;
        $rem = round($rem);
        foreach ($this->sbank as $aBank) {
            $rem = $this->trigger('set'.$aBank, $rem);
            if ($rem == 0) {
                break;
            }
        }
    }
    public function getBank()
    {
        $newbank = [];
        foreach ($this->bank as $dem=>$count) {
            if ($count > 0) {
                $newbank[$dem]=$count;
            }
        }
        return $newbank;
    }

    final protected function hasMethod($myMeth):bool
    {
        return method_exists($this, $myMeth);
    }

    final protected function trigger($func, $item)
    {
        if ($this->hasMethod($func)) {
            return $this->$func($item);
        }
    }

    final protected function setFiveThousand(int $num)
    {
        $div = 500000;
        $denom='Hundred';
        return $this->squize($num, $div, $denom);
    }

    final protected function setOneThousand(int $num)
    {
        $div = 100000;
        $denom='Hundred';
        return $this->squize($num, $div, $denom);
    }

    final protected function setFiveHundred(int $num)
    {
        $div = 50000;
        $denom='Hundred';
        return $this->squize($num, $div, $denom);
    }

    final protected function setTwoHundred(int $num)
    {
        $div = 20000;
        $denom='TwoHundred';
        return $this->squize($num, $div, $denom);
    }

    final protected function setHundred(int $num)
    {
        $div = 10000;
        $denom='Hundred';
        return $this->squize($num, $div, $denom);
    }
    final protected function setFifty(int $num)
    {
        $div = 5000;
        $denom='Fifty';
        return $this->squize($num, $div, $denom);
    }

    final protected function setTwenty(int $num)
    {
        $div = 2000;
        $denom='Twenty';
        return $this->squize($num, $div, $denom);
    }

    final protected function setTen(int $num)
    {
        $div = 1000;
        $denom='Ten';
        return $this->squize($num, $div, $denom);
    }

    final protected function setFive(int $num)
    {
        $div = 500;
        $denom='Five';
        return $this->squize($num, $div, $denom);
    }

    final protected function setOne(int $num)
    {
        $div = 100;
        $denom='One';
        return $this->squize($num, $div, $denom);
    }

    public function validateTransaction()
    {
        $goodCost = $this->testMoneyInput($this->cost);
        $goodAmount = $this->testMoneyInput($this->amount);
        $result = $goodCost && $goodAmount;
        if (!$result) {
            $this->error= true;
            $this->validated = false;
            $this->message = 'one ore more value has a wrong format';
            $this->status = 3000; //validation error
        }
    }

    final public function calculate()
    {
        $balance = $this->amount - $this->cost;
        return $balance;
    }

    final protected function testMoneyInput($money)
    {
        $goodPathern = '/([0-9.])/';
        $goodMoney = true;
        $moneyA = str_split($money, 1);
        foreach ($moneyA as $unit) {
            $goodP = preg_match($goodPathern, $unit);
            if (!$goodP) {
                $goodMoney = false;
                break;
            }
        }
        return $goodMoney;
    }

    final public function validated()
    {
        return $this->validated;
    }

    final public function getStatus()
    {
        return $this->status;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
