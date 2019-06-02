<?php


namespace App\Service;

use App\Interfaces\AppMoneyInterface;

class USAMoney extends WorldMoney implements AppMoneyInterface
{
    protected $bank;
    protected $sbank;
    protected $denom;
    public function __construct($cost=0, $amount=0)
    {
        parent::__construct($cost, $amount);
        $this->bank = ['Hundred'=>0,'Fifty'=>0,'Twenty'=>0,'Ten'=>0,'Five'=>0,'One'=>0,'Quarter'=>0,'Dime'=>0,'Nickle'=>0,'Penny'=>0];
        $this->denom =['Hundred'=>100,'Fifty'=>50,'Twenty'=>20,'Ten'=>10,'Five'=>5,'One'=>1,'Quarter'=>.25,
                      'Dime'=>.10,'Nickle'=>.05,'Penny'=>.01];
    }
    public function setTransaction($totalCost=0, $amountProvided=0)
    {
        $this->cost = $totalCost;
        $this->amount = $amountProvided;
    }

    public function getDenom()
    {
        return $this->denom;
    }

    public function getAllBank()
    {
        return $this->bank;
    }
}
