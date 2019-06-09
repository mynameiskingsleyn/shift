<?php

namespace App\Controller\Api;

use App\Service\USAMoney;
use App\Repository\AppRepository\AppMoneyRepository;
//use Symfony\Component\Routing\Annotation\Route;
use App\Interfaces\AppMoneyInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\MoneyRepository;
use App\Repository\DenomRepository;
use Psr\Log\LoggerInterface;

/**
* @Route("/api",name="api_")
*/
class CashierController extends Controller //AbstractController
{
    private $money;
    private $moneyRepo;
    private $denomRepo;
    public function __construct(AppMoneyRepository $money, DenomRepository $denomRepo, MoneyRepository $moneyRepo)
    {
        $this->money = $money;
        $this->denomRepo = $denomRepo;
        $this->moneyRepo = $moneyRepo;
    }
    /**
    * @Rest\Get("/checkout",name="calculate_change")
    */
    public function calculateChange(Request $request, LoggerInterface $logger)
    {
        //sample api.endpoint url http://switch.test/api/checkout?total_cost=234.34&amount_provided=340.353
        $logger->info('Calculating change');
        $total_cost = $request->get('total_cost');
        $amount_provided = $request->get('amount_provided');
        if ($total_cost==null || $amount_provided ==null) {
            $data = [
            'error'=>1,
            'status' => 206, //missing entry
            'error_message'=> 'Error: One or more entries are missing'
          ];
            return new JsonResponse($data);
        }
        $this->money->setModel(new USAMoney($this->moneyRepo, $this->denomRepo));// for usa currency api
        $this->money->setTransaction($total_cost, $amount_provided);
        $this->money->validateTransaction();
        //dd($this->money->validated());

        if (!$this->money->validated()) {
            $data = [
              'error'=>1,
            'status' => $this->money->getStatus(),
            'error_message'=> $this->money->getMessage()
          ];

            return new JsonResponse($data);
        }
        $balance = $this->money->calculate();
        if ($balance < 0) {
            $data = [
            'error'=> 1,
            'status'=> 412,
            'error_message'=>'More money required'
          ];
        } elseif ($balance == 0) {
            $data = [
            'error' => 0,
            'status'=>200,
            'message'=> 'No change for transaction'
          ];
        } else {
            $this->money->tenderChange($balance);
            $data = [
            'error'=>0,
            'status'=>200,
            'balance'=>money_format('$%i', $balance),
            'change' =>$this->money->getBank()
          ];
        }
        return new JsonResponse($data);
    }

    /**
    * @Rest\Get("/total",name="calculate_total")
    */

    public function calculate_total(Request $request)
    {
        $denoms = $this->money->getDenom();
        $addes = [];
        foreach ($denoms as $key=>$denom) {
            $got = $request->get($key);
            if (is_numeric($got)) {
                $mult = $denom * $got;
                $addes[] = $mult;
            }
        }
        $sum = 0;
        foreach ($addes as $add) {
            $sum += $add;
        }
        $data = [
        'error'=>0,
        'sum' => $sum, //missing entry
      ];
        //var_dump($request->input('Fifty'));
        return new JsonResponse($data);
    }
}
