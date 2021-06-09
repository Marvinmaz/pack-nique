<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController{
    /**
     * @Route("/")
     */
    public function contact()
    {
        return $this->redirectToRoute("/contact");
    }
}