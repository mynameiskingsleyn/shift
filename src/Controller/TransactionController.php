<?php

namespace App\Controller;

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
use Symfony\Component\HttpFoundation\JsonRequest;

class TransactionController extends Controller
{
    /**
    * @Rest\Get("/checkout",name="checkout")
    */
    public function checkout(Request $request)
    {
        //dd('Working yall');
        $total_cost = $request->get('total_cost')? : 300;
        $amount_provided = $request->get('amount_provided')? : 310;
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
        if ($returned->error == 0) {
            //dd($returned);
            $balance = $returned->balance;
            $change = $returned->change;
            dd($change);
            dd($returned->balance);
        } else {
            dd("error occured--> ".$returned->error_message);
        }


        //
        //return new Response('');
    }
}
