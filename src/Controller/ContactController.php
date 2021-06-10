<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class ContactController extends AbstractController{
    /**
     * @Route("/")
     */
    public function contact()
    {
        return $this->redirectToRoute("/contact");
    }
}