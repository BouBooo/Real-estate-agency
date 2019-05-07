<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
       /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environnement
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Agence :' . $contact->getProperty()->getTitle()))
                    ->setFrom('noreply@agence.fr')
                    ->setTo('contact@florentnicolas.com')
                    ->setReplyTo($contact->getEmail())
                    ->setBody($this->render('emails/contact.html.twig', [
                        'contact' => $contact
                    ]), 'text/html');
        $this->mailer->send($message);
    }
}
