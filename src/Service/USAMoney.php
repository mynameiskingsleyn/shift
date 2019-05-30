<?php


namespace App\Service;

use App\Interfaces\AppMoneyInterface;

class USAMoney extends WorldMoney implements AppMoneyInterface
{
    protected $bank;
    protected $sbank;
    public function __construct($cost=0, $amount=0)
    {
        parent::__construct($cost, $amount);
        $this->bank = ['Hundred'=>0,'Fifty'=>0,'Twenty'=>0,'Ten'=>0,'Five'=>0,'One'=>0,'Quarter'=>0,'Dime'=>0,'Nickle'=>0,'Penny'=>0];
        $this->sbank=['Hundred','Fifty','Twenty','Ten','Five','One','Quarter','Dime','Nickle','Penny'];
    }

    protected function setQuarter(int $num)
    {
        $div = 25;
        $denom='Quarter';
        return $this->squize($num, $div, $denom);
    }
    protected function setDime(int $num)
    {
        $div = 10;
        $denom='Dime';
        return $this->squize($num, $div, $denom);
    }
    protected function setNickle(int $num)
    {
        $div = 5;
        $denom='Nickle';
        return $this->squize($num, $div, $denom);
    }
    protected function setPenny(int $num)
    {
        $div = 1;
        $denom='Penny';
        return $this->squize($num, $div, $denom);
    }

    public function setTransaction($totalCost=0, $amountProvided=0)
    {
        $this->cost = $totalCost;
        $this->amount = $amountProvided;
    }

    public function getSbank()
    {
        return $this->sbank;
    }
}
