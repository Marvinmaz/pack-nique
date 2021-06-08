<?php

namespace App\Controller;

use App\Entity\Pack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PackController extends AbstractController{
    /**
     * @Route("/CreatePack", name="pack")
     */
    public function newPack(Request $request): Response{
        $pack = new Pack();

        $form = $this
    }
}