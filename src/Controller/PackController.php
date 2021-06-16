<?php

namespace App\Controller;

use App\Entity\Pack;
use App\Entity\Comment;
use App\Form\PackType;
use App\Form\CommentType;
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
    }

    /**
     * @Route("/update-pack/{id}", name="updatePack")
     */
    public function update(Request $request, Pack $updatePack, SluggerInterface $slugger): Response{
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
    public function read(Request $request, Pack $pack): Response{

        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pack_id = $pack->getId();
            // you can fetch the EntityManager via $this->getDoctrine()
            $entityManager = $this->getDoctrine()->getManager();

            $comment = new Comment();
            $comment->setContent($form->getData()['Comment']);
            $comment->setPack($pack);
            $comment->setUser($this->getUser());
            $comment->setNote(12);
            $comment->setCreatedAt(new \DateTime());
            
            // tell Doctrine you want to (eventually) save the Comment (no queries yet)
            $entityManager->persist($comment);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
        }
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $pack_id = $pack->getId();

        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findBy(["pack_id" => $pack_id]);

        return $this->render("pack/readPack.html.twig", [
            'form' => $form->createView(),
            "pack" => $pack,
            "comments" => $comments
        ]);
    }


    /**
     * @Route("/view-pack", name="viewPack")
     */
    public function viewPack(): Response{
        return $this->render('pack/view.html.twig');
    }

    /**
     * @Route("/categories/{category}", name="categories")
     * @Route("/Categories/{Category}", name="categories")
     */
    public function viewCategory(Request $request): Response{
        $categories = Pack::STANDARD_CATEGORIES;
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $packs=$repository->findAll();
        $category = $request->attributes->get('category');
        // $category = 'anniversaire';
        return $this->render("pack/categories.html.twig", [
            'categories' => $categories,
            'category' => $category, 
            'packs' => $packs
        ]);
    }

}