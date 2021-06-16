<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Pack;
use App\Entity\User;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CommentController extends AbstractController{
    /**
     * @Route("/create-comment/{id}", name="createComment")
     */
    public function newComment(Request $request, Pack $pack): Response{
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
       
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $date = new \DateTime();
            $comment->setCreatedAt($date);
            $comment->setPack($pack);
            $comment->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('comment/createComment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/update-comment/{id}", name="updateComment")
     */
    public function update(Request $request, Comment $updateComment): Response{
        $form = $this->createForm(CommentType::class, $updateComment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("home");
        }

        return $this->render('comment/createComment.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete-comment/{id}", name="deleteComment")
     */
    public function delete(Comment $delete): Response{
        $em = $this->getDoctrine()->getManager();
        $em->remove($delete);
        $em->flush();

        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/read-comments/{id}", name="readComments")
     */
    public function readAll(Pack $pack): Response{
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $repository->findBy(["pack" => $pack]);
        dump($comments);
        return $this->render("pack/readPack.html.twig", [
            "pack" => $pack,
            "comments" => $comments,
        ]);
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }

}