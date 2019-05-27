<?php

namespace Test\AppRepository;

use App\Service\USAMoney;

use App\Repository\AppRepository\AppMoneyRepository;

use PHPUnit\Framework\TestCase;

class AppMoneyRepositoryTest extends TestCase
{
    public function testRepoCalculate()
    {
        $tendered = 234;
        $cost = 232;
        $usMoney = new USAMoney($cost, $tendered);
        $moneyRepo = new AppMoneyRepository($usMoney);
        $balance = $moneyRepo->calculate();
        $this->assertEquals(2, $balance);
    }

    public function testRepoTenderChange()
    {
        $num = 235;
        $usMoney = new USAMoney();
        $moneyRepo = new AppMoneyRepository($usMoney);
        $bank = $moneyRepo->getBank();
        //dd($usMoney);
        $this->assertEmpty($bank);
        $moneyRepo->tenderChange($num);
        //dd($usMoney);
        $newBank = $moneyRepo->getBank();
        //dd($newBank); // correnct result
        $expected = ["Hundred"=>2,"Twenty"=>1,"Ten"=>1,"Five"=>1];

        foreach ($expected as $key=>$value) {
            $this->assertTrue(array_key_exists($key, $newBank));
            $this->assertTrue($newBank[$key]==$value);
        }
    }

    public function testRepoValidation()
    {
        $cost = 234.23;
        $tendered = 345.45;
        $usMoney = new USAMoney($cost, $tendered);
        $moneyRepo = new AppMoneyRepository($usMoney);
        $this->assertTrue($moneyRepo->validated());
        $moneyRepo->validateTransaction();
        $this->assertTrue($moneyRepo->validated());
        $newCost = 234.5334;
        $moneyRepo->setTransaction($newCost, $tendered);
        $moneyRepo->validateTransaction();
        $this->assertFalse($moneyRepo->validated());
    }
}
