<?php

namespace App\Controller;

use App\Service\USAMoney;
use App\Repository\AppRepository\AppMoneyRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Interfaces\AppMoneyInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations as Rest;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\JsonRequest;

class TransactionController extends Controller
{
    protected $money;
    public function __construct(AppMoneyRepository $money)
    {
        $this->money = $money;
    }
    /**
    * @Rest\Post("/checkout",name="checkout")
    */
    public function checkout(Request $request)
    {
        //dd('Working yall');

        $total_cost = $request->get('total_cost');
        $amount_provided = $request->get('amount_provided');
        $bank_money = new USAMoney($total_cost, $amount_provided);
        $this->money->setModel($bank_money);

        //dd($total_cost);
        //$url = "http://switch.test/api/checkout?total_cost=$total_cost&amount_provided=$amount_provided";
        $url = 'http://switch.test/api/checkout';
        $data = ['total_cost' => $total_cost, 'amount_provided'=>$amount_provided];
        $curl = curl_init();
        // // curl_setopt($curl,CURLOPT_POST,1), if($data ) curl_setopt
        // //.....curl_setopt($curl,CURLOPT_POST,1)
        $url = sprintf("%s?%s", $url, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        $returned = json_decode($result);
        //dd($returned);
        $change = $returned->change;
        if ($returned->error == 0) {
            $result = [];
            $denoms = $this->money->getSbank();
            //dd($denoms);
            $money_out =[];
            foreach ($denoms as $aChange) {
                if (isset($change->$aChange)) {
                    $money_out[$aChange] = $change->$aChange;
                }
            }
            $result['cost'] = $total_cost;
            $result['amount'] = $amount_provided;
            $result['balance'] = $returned->balance;
            $result['change'] = $money_out;
            //dd($result);
            return $this->render('cashRegister/change.html.twig', [
              'result' => $result
            ]);
        } else {
            dd("error occured--> ".$returned->error_message);
            return $this->redirectToRoute('pay');
        }


        //
        //return new Response('');
    }
    /**
    * @Route("/pay",name="Pay")
    */

    public function pay(Request $request)
    {
        //
        return $this->render('cashRegister/checkout.html.twig');
    }
}
