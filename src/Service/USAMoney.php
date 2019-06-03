<?php


namespace App\Service;

use App\Interfaces\AppMoneyInterface;
use App\Entity\Money;
use App\Entity\Denom;
use App\Repository\MoneyRepository;
use App\Repository\DenomRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class USAMoney extends WorldMoney implements AppMoneyInterface
{
    protected $bank;
    protected $sbank;
    protected $denom;
    protected $ourMoney;
    protected $moneyRepo;
    protected $denomRepo;
    public function __construct($cost=0, $amount=0, MoneyRepository $moneyRepo, DenomRepository $denomRepo)
    {
        parent::__construct($cost, $amount);
        $this->moneyRepo = $moneyRepo;
        $this->denomRepo = $denomRepo;
        $money = $this->moneyRepo->findBy(['name'=>'UsaMoney']);
        $this->ourMoney = $money[0];
        $denoms = $this->ourMoney->getDenoms();
        if ($denoms) {
            foreach ($denoms->toArray() as $adenom) {
                $this->denom[$adenom->getName()]= $adenom->getValue();
                $this->bank[$adenom->getName()] = 0;
            }
        } else {
            $this->denom =['Hundred'=>100,'Fifty'=>50,'Twenty'=>20,'Ten'=>10,'Five'=>5,'One'=>1,'Quarter'=>.25,
                        'Dime'=>.10,'Nickle'=>.05,'Penny'=>.01];
            $this->bank = ['Hundred'=>0,'Fifty'=>0,'Twenty'=>0,'Ten'=>0,'Five'=>0,'One'=>0,'Quarter'=>0,'Dime'=>0,'Nickle'=>0,'Penny'=>0];
        }
        //=$this->moneyRepo->findBy(['name'=>'UsaMoney'], ['created_at'=>'DESC']);
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
