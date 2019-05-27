<?php

namespace Test\Service;

use App\Service\USAMoney;

use PHPUnit\Framework\TestCase;

class USAMoneyTest extends TestCase
{
    public function testCalculate()
    {
        $tendered = 234;
        $cost = 232;
        $usMoney = new USAMoney($cost, $tendered);
        $balance = $usMoney->calculate();
        $this->assertEquals(2, $balance);
    }

    public function testTenderChange()
    {
        $num = 235;
        $usMoney = new USAMoney();
        $bank = $usMoney->getBank();
        //dd($usMoney);
        $this->assertEmpty($bank);
        $usMoney->tenderChange($num);
        //dd($usMoney);
        $newBank = $usMoney->getBank();
        //dd($newBank); // correnct result
        $expected = ["Hundred"=>2,"Twenty"=>1,"Ten"=>1,"Five"=>1];

        foreach ($expected as $key=>$value) {
            $this->assertTrue(array_key_exists($key, $newBank));
            $this->assertTrue($newBank[$key]==$value);
        }
        // $usMoney->tenderChange($num);
        //dd($newBank);
    }
}
