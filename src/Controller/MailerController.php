<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MailerController extends AbstractController {
    /**
     * @Route("/contact-sana")
     */
    public function sendEmailSana(MailerInterface $mailer) {
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
        
    }

    /**
     * @Route("/contact-marvin")
     */
    public function sendEmailMarvin(MailerInterface $mailer) {
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
        
    }
    /**
     * @Route("/contact-sebastien")
     */
    public function sendEmailSébastien(MailerInterface $mailer) {
        $email = (new Email())
            ->from(new Address('fabien@example.com'))            
            ->to('sebmichaut00@gmail.com')
            ->subject('Nous sommes la pour vous')
            ->text('Que pouvons nous faire pour vous aider ?')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {
                dump($e);
            }
        
    }/**
     * @Route("/contact-steven")
     */
    public function sendEmailSteven(MailerInterface $mailer) {
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
        
    }
}