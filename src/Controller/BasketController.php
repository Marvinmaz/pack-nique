<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController {

    /**
     * @Route("/basket", name="cart_index")
     */

    public function index(){
         return $this->render('basket.html.twig', [

         ]);
    }

    /**
     * @Route("/basket/add/{id}", name="cart_add")
     */

    public function add($id, Request $request){
        $session = $request->getSession();
        
        $basket = $session->get('basket', []);

        $basket[$id] = 1;

        $session->set('basket', $basket);

        dd($session->get('basket'));
    }
}