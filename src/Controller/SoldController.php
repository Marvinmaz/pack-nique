<?php

namespace App\Controller;

use App\Entity\Sold;
use App\Form\SoldType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SoldController extends AbstractController{

    /**
     * @Route("/sold", name="sold")
     */
    public function createSold(SessionInterface $session): Response {
        $sold = new Sold();
        $form = $this->createForm(SoldType::class, $sold);
        $basket = $session->get("basket");
        $totalPrice = $session->get("totalPrice");
        dump($totalPrice);
        // foreach ($basket as $id => $quantity) {
            
        // }
        return $this-> render('sold/sold.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}