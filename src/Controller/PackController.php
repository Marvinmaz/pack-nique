<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Form\PackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class PackController extends AbstractController{
    /**
     * @Route("/create-pack", name="createPack")
     */
    public function newPack(Request $request, SluggerInterface $slugger): Response{
        
        if ($this->getUser()->getIsAdmin(1)) {
            $pack = new Pack();
            $form = $this->createForm(PackType::class, $pack);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $pack->setSales_volume(0);
                $picture = $form->get('picture')->getData();
    
                // this condition is needed because the 'picture' field is not required
                // so the picture file must be processed only when a file is uploaded
                if($picture){
                    $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();
    
                    // Move the file to the directory where brochures are stored
                    try {
                        $picture->move(
                            $this->getParameter('images'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        dump($e);
                        // ... handle exception if something happens during file upload
                    }
    
                    // updates the 'pictureFilename' property to store the PDF file name
                    // instead of its contents
                    $pack->setPicture($newFilename);
                }
               
                $em = $this->getDoctrine()->getManager();
                $em->persist($pack);
                $em->flush();
    
                return $this->redirectToRoute("home");
            }
            return $this->render('pack/createPack.html.twig', [
               'form' => $form->createView()
           ]);

        } else {
            return $this->redirectToRoute("home");
        }               

       
    }

    /**
     * @Route("/update-pack/{id}", name="updatePack")
     */
    public function update(Request $request, Pack $updatePack, SluggerInterface $slugger): Response{
        if ($this->getUser()->getIsAdmin(1)) {
            $form = $this->createForm(PackType::class, $updatePack);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $picture = $form->get('picture')->getData();

                // this condition is needed because the 'picture' field is not required
                // so the picture file must be processed only when a file is uploaded
                if($picture){
                    $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $picture->move(
                            $this->getParameter('images'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        dump($e);
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'pictureFilename' property to store the PDF file name
                    // instead of its contents
                    $updatePack->setPicture($newFilename);
                }

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute("home");
            }

        return $this->render('pack/updatePack.html.twig', [
            'form' => $form->createView()
        ]);
        } else {
            return $this->redirectToRoute("home");
        }  
    }

    /**
     * @Route("/delete-pack/{id}", name="deletePack")
     */
    public function delete(Pack $delete): Response{
        $em = $this->getDoctrine()->getManager();
        $em->remove($delete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/", name="home")
     */
    public function readAll(): Response{
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $packs = $repository->findAll();
        return $this->render("index.html.twig", [
            "packs" => $packs
        ]);
    }

    /**
     * @Route("/read-pack/{id}", name="readPack")
     */
    public function read(Pack $pack): Response{
        return $this->render("pack/readPack.html.twig", [
            "pack" => $pack
        ]);
    }
}