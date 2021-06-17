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
        $totalPrice = $session->get("totalPrice");                          // On récupère le prix total dans la session
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if ($sold->getCode() === "reduc") {                             // Easter egg, si on met ce code le prix sera 20% moins cher
                $totalPrice *= 4/5;
                $session->set("totalPrice", $totalPrice);
            }
        }
        return $this-> render('sold/sold.html.twig', [
            'form' => $form->createView(),
            'totalPrice' => $totalPrice,
        ]);
    }
}