<?php 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController{

    /**
     * @Route("/create-account", name="account")
     */
    public function createAccount(Request $request): Response
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setIsAdmin(0);

            $em->persist($user);
            $em->flush();
            
            
            return $this->redirectToRoute('account');
        }
        return $this->render("./account.html.twig", [
            'form' => $form->createView()
        ]);
    }


     /**
        * @Route("/updateUser/{id}", name="updateUser")
        */
    public function update(Request $request, User $user) : Response
    {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute("home");

        }

        return $this->render('modify-account.html.twig', [
            'form' => $form->createView()
        ]);
    }







}
