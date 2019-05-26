<?php

namespace App\Controller\Api;

use App\Service\USAMoney;
//use App\Interfaces\AppMoneyInterface;
use App\Repository\AppRepository\AppMoneyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/cashierapi")
*/
class CashierController extends AbstractController
{
    private $money;
    public function __construct(AppMoneyRepository $money)
    {
        $this->money = $money;
    }
    /**
    * @Route("/calculatechange",name="calculate_change")
    */
    public function calculateChange(Request $request)
    {
        //sample api.endpoint url http://switch.test/cashierapi/calculatechange?total_cost=234.34&amount_provided=345.33

        $total_cost = $request->get('total_cost');
        $amount_provided = $request->get('amount_provided');
        if ($total_cost==null || $amount_provided ==null) {
            $data = [
            'error'=>1,
            'status' => 10000, //missing entry
            'message'=> 'Error: One or more entries are missing'
          ];
            return new Response(json_encode($data));
        }
        $this->money->setModel(new USAMoney($total_cost, $amount_provided));// for usa currency api
        $this->money->validateTransaction();
        //$validated = $this->money->validated();
        if (!$this->money->validated()) {
            $data = [
              'error'=>1,
            'status' => $this->money->getStatus(),
            'message'=> $this->money->getMessage()
          ];

            return new Response(json_encode($data));
        }
        $balance = $this->money->calculate();
        if ($balance < 0) {
            $data = [
            'error'=> 1,
            'status'=> 3000,
            'message'=>'More money required'
          ];
        } elseif ($balance == 0) {
            $data = [
            'error' => 0,
            'status'=>201,
            'message'=> 'No change for transaction'
          ];
        } else {
            $this->money->tenderChange($balance);
            $data = [
            'error'=>0,
            'status'=>201,
            'balance'=>money_format('$%i', $balance),
            'change' =>$this->money->getBank()
          ];
        }

        return new Response(json_encode($data));
    }
}
