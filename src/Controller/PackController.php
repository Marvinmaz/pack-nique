<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Form\PackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PackController extends AbstractController{
    /**
     * @Route("/CreatePack", name="pack")
     */
    public function newPack(Request $request): Response{
        $pack = new Pack();

        $form = $this->createForm(PackType::class, $pack);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pack);
            $em->flush();

            return $this->redirectToRoute("base");
        }

        return $this->render('pack/createPack.html.twig', [
            'form' => $form->createView()
        ]);
    }
}