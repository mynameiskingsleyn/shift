<?php

namespace App\DataFixtures;

use App\Entity\Denom;
use App\Entity\Money;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const USADENOM = [
        ['name'=>'Hundred','value'=>100.00],
        ['name'=>'Fifty','value'=>50.00],
        ['name'=>'Twenty','value'=>20.00],
        ['name'=>'Ten','value'=>10.00],
        ['name'=>'Five','value'=>5.00],
        ['name'=>'One','value'=>1.00],
        ['name'=>'Quarter','value'=>.25],
        ['name'=>'Dime','value'=>0.10],
        ['name'=>'Nickle','value'=>0.05],
        ['name'=>'Peny','value'=>0.01]
      ];
    private const USAMONEY =['name'=>'UsaMoney'];

    public function load(ObjectManager $manager)
    {
        $this->loadUsaMoney($manager);
        $this->loadUsaDenom($manager);
    }

    private function loadUsaMoney(ObjectManager $manager)
    {
        $money = new Money();
        $pos = self::USAMONEY;

        $money->setName('UsaMoney');
        $manager->persist($money);

        $manager->flush();
        $this->addReference('usaMoney', $money);
    }
    private function loadUsaDenom(ObjectManager $manager)
    {
        foreach (self::USADENOM as $den) {
            $denom = new Denom();
            $denom->setName($den['name']);
            $denom->setValue($den['value']);
            $denom->getMoney()
                  ->add($this->getReference('usaMoney'));
            $manager->persist($denom);
        }
        $manager->flush();
    }
}
