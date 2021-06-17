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

        $sold = new Sold();                                         // On créer un nouvel objet commande
        $sold->setPrice($session->get("totalPrice"));               // On remplit cette commande avec le prix total, le user, la date...
        $sold->setUser($this->getUser());
        $sold->setInProgress(0);
        $sold->setCreatedAt(new \DateTime());

        $em = $this->getDoctrine()->getManager();                   
        $em->persist($sold);
        $em->flush();                                               // On l'inscrit en base de données                                                       
                                                      
        $session->set('basket', []);
        $this->addFlash("merci", "Votre commande a bien été passée, merci !");    // On fait un message flash en confirmation dans le commande et on l'affiche en page d'accueil
        return $this->redirectToRoute("home");
    }
}