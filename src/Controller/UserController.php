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
                // IMAGE EN CONSTRUCTION    
                $picture = $form->get('pics')->getData();
    
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
                    $user->setPics($newFilename);
                }
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

       


