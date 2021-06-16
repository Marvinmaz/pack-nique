<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class ContactController extends AbstractController{
    /**
     * @Route("/contact")
     */
    public function contact()
    {
        return $this->render("/contact/contact.html.twig");
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }
}
