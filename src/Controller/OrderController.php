<?php

namespace App\Controller;

use App\Entity\Sold;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController{

    /**
     * @Route("/order", name="order")
     */
    public function order(SessionInterface $session): Response {

        $sold = new Sold();
        $sold->setPrice($session->get("totalPrice"));
        $sold->setUser($this->getUser());
        $sold->setInProgress(0);
        $sold->setCreatedAt(new \DateTime());
        $em = $this->getDoctrine()->getManager();
        $em->persist($sold);
        $em->flush();
        $session->set('basket', []);
        $this->addFlash("merci", "Votre commande a bien été passée, merci !");
        return $this->redirectToRoute("home");
    }
}