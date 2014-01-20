<?php

namespace Asbo\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Asbo\Bundle\ContactBundle\Entity\Enquiry;
use Asbo\Bundle\ContactBundle\Form\EnquiryType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

            $form->handleRequest($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Message envoyé via asbo.com')
                    ->setFrom($this->container->getParameter('asbo_contact.emails.info'))
                    ->setTo($this->container->getParameter('asbo_contact.emails.xxxx'))
                    ->setBody($this->renderView('AsboContactBundle:Default:email.txt.twig', array('enquiry' => $enquiry)))
                    ->setTo($this->container->getParameter('asbo_contact.emails.'.$enquiry->getDestination()));

                $this->get('mailer')->send($message);

                $this->get('session')->getFlashBag()->add('contact-notice', 'Votre message a bien été envoyé !');

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('asbo_contact'));
            }

        $username = '';
        $useremail = '';

        $user= $this->get('security.context')->getToken()->getUser();
        if (is_object($user)) {
            $username = $user->getFirstname() . ' ' . $user->getLastname();
            $useremail = $user->getEmail();
        }

        return $this->render('AsboContactBundle:Default:index.html.twig', array(
                'form' => $form->createView(),
                'comite' => $this->container->getParameter('asbo_contact.emails.comite'),
                'xxxx' => $this->container->getParameter('asbo_contact.emails.xxxx'),
                'fsb' => $this->container->getParameter('asbo_contact.emails.fsb'),
                'cavasbo' => $this->container->getParameter('asbo_contact.emails.cavasbo'),
                'webmaster' => $this->container->getParameter('asbo_contact.emails.webmaster'),
                'username' => $username,
                'useremail' => $useremail
        ));
    }

}
