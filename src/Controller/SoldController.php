<?php

namespace App\Controller;

use App\Entity\Sold;
use App\Form\SoldType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SoldController extends AbstractController{

    /**
     * @Route("/sold", name="sold")
     */
    public function createSold(SessionInterface $session, Request $request): Response {
        $sold = new Sold();
        $form = $this->createForm(SoldType::class, $sold);
        $totalPrice = $session->get("totalPrice");
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if ($sold->getCode() === "reduc") {
                $totalPrice *= 4/5;
            }
        }
        return $this-> render('sold/sold.html.twig', [
            'form' => $form->createView(),
            'totalPrice' => $totalPrice,
        ]);
    }
}