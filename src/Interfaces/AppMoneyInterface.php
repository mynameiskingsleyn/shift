<?php

namespace App\Interfaces;

interface AppMoneyInterface extends AppBaseInterface
{
    public function tenderChange($num);

    public function getBank();

    public function validateTransaction();

    public function validated();

    public function getMessage();
}
