<?php

namespace App\Service;

use App\Interfaces\AppServiceMoneyInterface;
use Psr\Log\LoggerInterface;

abstract class WorldMoney implements AppServiceMoneyInterface
{
    protected $cost;
    protected $amount;
    protected $balance;
    protected $error;
    protected $success;
    protected $message;
    protected $validated;
    protected $status;
    protected $bank;
    protected $sBank;
    protected $denom;
    protected $logger;
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
        foreach ($this->denom as $key=> $value) {
            $note =[$key=>$value];
            $rem = $this->factor('reduce', $note, $rem);
            if ($rem == 0) {
                break;
            }
        }
    }

    public function factor($reduce, $bank, $item)
    {
        if ($this->hasMethod($reduce)) {
            return $this->$reduce($bank, $item);
        }
    }

    public function reduce($bank, $item)
    {
        $denom = key($bank);
        $value = $bank[$denom];
        $num = $item;
        $div = $value * 100;
        return $this->squize($num, $div, $denom);
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
        $goodPattern = '/^\d{0,10}.?\d{0,2}$/';
        $goodMoney = preg_match($goodPattern, $money);
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

    abstract public function getDenom();
    abstract public function getAllBank();
}
