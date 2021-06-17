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
        
        if ($this->getUser()->getIsAdmin(1)) {      // On vérifie que l'utilisateur est bien un administrateur
            $pack = new Pack();
            $form = $this->createForm(PackType::class, $pack); //On créer le formulaire dans Form (PackType)
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {  // Si le formulaire est bien rempli 
                $pack->setSales_volume(0);                    // On initialise le nombre de ventes du produit à 0
                $picture = $form->get('picture')->getData();   // On récupère l'image
    
                // Comme il n'est pas obligatoire d'avoir une image, on traite le fichier seulement si il est téléchargé
                if($picture){
                    $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                    // Pour inclure le nom du fichier dans l'URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();   // On génére un identifiant unique à l'image
    
                    try {
                        $picture->move(
                            $this->getParameter('images'),                // On déplace le fichier dans le dossier images
                            $newFilename
                        );
                    } catch (FileException $e) {                    // On gère une exception si quelque chose se produit pendant le téléchargement
                        dump($e);
                        
                    }

                    $pack->setPicture($newFilename);         // On stocke le nom du fichier dans le pack au lieu de son contenu
                }
               
                $em = $this->getDoctrine()->getManager();      // On l'enregistre en base de données
                $em->persist($pack);
                $em->flush();
    
                return $this->redirectToRoute("home");            // Une fois que le pack est créer, on retourne sur la page d'accueil
            }
            return $this->render('pack/createPack.html.twig', [     // On affiche le formulaire sur cette route
               'form' => $form->createView()
           ]);

        } else {
            return $this->redirectToRoute("home");           // Si l'utilisateur n'est pas un administrateur, on le renvoie sur la page d'accueil
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
                
                if($picture){
                    $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

                    try {
                        $picture->move(
                            $this->getParameter('images'),
                            $newFilename);
                    } catch (FileException $e) {
                        dump($e);
                    }

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
     * @Route("/Categories/{category}", name="categories")
     */
    public function viewCategory(Request $request, string $category): Response{
        $categories = Pack::STANDARD_CATEGORIES;
        $repository = $this->getDoctrine()->getRepository(Pack::class);
        $packs=$repository->findAll();
        return $this->render("pack/categories.html.twig", [
            'categories' => $categories,
            'category' => $category, 
            'packs' => $packs,
        ]);
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }
}