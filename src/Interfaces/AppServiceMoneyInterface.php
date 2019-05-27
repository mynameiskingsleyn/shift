<?php

namespace App\Interfaces;

interface AppServiceMoneyInterface extends AppBaseInterface
{
    public function tenderChange($num);
    public function getBank();
    public function getMessage();
}
