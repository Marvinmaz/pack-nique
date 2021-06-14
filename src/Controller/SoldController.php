<?php

namespace App\Controller;

use App\Entity\Sold;
use App\Form\SoldType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class SoldController extends AbstractController{
    /**
     * @Route("/sold", name="sold")
     */
    public function createSold(): Response {
        $sold = new Sold();
        $form = $this->createForm(SoldType::class, $sold);

        return $this-> render('sold/sold.html.twig', [
            'form' => $form->createView()
        ]);
    }
}