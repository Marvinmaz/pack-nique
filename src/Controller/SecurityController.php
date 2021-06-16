<?php 

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use  Symfony\Component\Security\Core\User\UserInterface;

class SecurityController extends AbstractController{

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(SessionInterface $session){
        $session->clear();
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/error", name="error")
     */
    public function error(){
        return $this->render("error/errorId.html.twig");
    }
}