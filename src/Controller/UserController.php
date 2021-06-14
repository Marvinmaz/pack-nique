<?php 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserInfoType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController{

    /**
     * @Route("/create-account", name="account")
     */
    public function createAccount(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User($userPasswordHasher);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setIsAdmin(0);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->render("./account.html.twig", [
            'form' => $form->createView()
        ]);
    }


    /**
    * @Route("/update-user/{username}", name="updateUser")
    */
    public function update(Request $request, User $user, SluggerInterface $slugger): Response
    {
        if ($this->getUser() === $user) {
            $form = $this->createForm(UserInfoType::class, $user);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute("home");
            }
            return $this->render("user/readUser.html.twig", [
                'form' => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute("error");
        }
        
    }
    
    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }




}
