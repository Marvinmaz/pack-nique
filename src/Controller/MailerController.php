<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Flex\Response as FlexResponse;

class MailerController extends AbstractController {
    /**
     * @Route("/contact-sana")
     */
    public function sendEmailSana(MailerInterface $mailer)/*:Response*/ {
        $email = (new Email())
            ->from(new Address('fabien@example.com'))            
            ->to('sana.rezaei75@gmail.com')
            ->subject('Nous sommes la pour vous')
            ->text('Que pouvons nous faire pour vous aider ?')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dump($e);
            }

            return $email;
        
        
    }

    /**
     * @Route("/contact-marvin")
     */
    public function sendEmailMarvin(MailerInterface $mailer)/*:Response*/ {
        $email = (new Email())
            ->from(new Address('fabien@example.com'))            
            ->to('marvinmazel9575@gmail.com')
            ->subject('Nous sommes la pour vous')
            ->text('Que pouvons nous faire pour vous aider ?')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dump($e);
            }
            return $email;
    }

    /**
     * @Route("/contact-sebastien")
     */
    public function sendEmailSébastien(MailerInterface $mailer)/*:Response*/ {
        $email = (new Email())
            ->from(new Address('{fabien@example.com}'))            
            ->to('sebmichaut00@gmail.com')
            ->subject('Nous sommes la pour vous')
            ->text('Que pouvons nous faire pour vous aider ?')
            ->html('<p>See Twig integration for better HTML integration!</p>');
        
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dump($e);
            }
            return $email;
    }
    
    /**
     * @Route("/contact-steven")
     */
    public function sendEmailSteven(MailerInterface $mailer)/*:Response*/ {
        $email = (new Email())
            ->from(new Address('fabien@example.com'))            
            ->to('stevennichollspro@gmail.com')
            ->subject('Nous sommes la pour vous')
            ->text('Que pouvons nous faire pour vous aider ?')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dump($e);
            }
        return $email;
    }
}