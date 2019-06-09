<?php
namespace App\Repository\AppRepository;

use App\Interfaces\AppMoneyInterface;
use App\Interfaces\AppServiceMoneyInterface;

class AppMoneyRepository implements AppMoneyInterface
{
    protected $model;

    public function __construct(AppServiceMoneyInterface $appMoney)
    {
        $this->model = $appMoney;
    }

    public function tenderChange($num)
    {
        return $this->model->tenderChange($num);
    }

    public function getBank()
    {
        return $this->model->getBank();
    }

    public function validateTransaction()
    {
        return $this->model->validateTransaction();
    }

    public function setModel($model)
    {
        $this->model = $model;
    }
    public function validated()
    {
        //dd($this->model);
        //dd('here now'.$this->model->validated());
        return $this->model->validated();
    }

    public function getStatus()
    {
        return $this->model->getStatus();
    }

    public function getMessage()
    {
        return $this->model->getMessage();
    }

    public function calculate()
    {
        return $this->model->calculate();
    }

    public function setTransaction($cost, $amount)
    {
        return $this->model->setTransaction($cost, $amount);
    }

    public function getSbank()
    {
        return $this->model->getSbank();
    }

    public function getDenom()
    {
        return $this->model->getDenom();
    }
}
