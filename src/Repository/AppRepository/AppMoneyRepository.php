<?php
namespace App\Repository\AppRepository;

use App\Interfaces\AppMoneyInterface;

class AppMoneyRepository implements AppMoneyInterface
{
    protected $model;

    public function __construc(AppMoneyInterface $appMoneyInterface)
    {
        $this->model = $appMoneyInterface;
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
}
