<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Participant;
use AppBundle\Form\ParticipantType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $participantsLeft = Participant::TOTAL - $this->getDoctrine()->getRepository('AppBundle:Participant')->getTotalCount();

        if (0 === $participantsLeft) {
            return $this->redirectToRoute('over');
        }

        $participant = new Participant();
        $form = $this->createForm(ParticipantType::class, $participant);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($participant);
            $this->getDoctrine()->getManager()->flush();

            $messageBird = new \MessageBird\Client($this->getParameter('msgbird-token'));
            $message = new \MessageBird\Objects\Message();
            $message->originator = 'MessageBird';
            $message->recipients = array($participant->phoneNumber);
            $message->body = sprintf("Cher (Chère) %s,\nPartagez avec nous les enchantements des effluves subtiles. Le soir venu vous recevrez la clé pour nous rejoindre. Gardez sous silence cette dernière pour préserver votre invitation.", $participant->firstname);

            $response = $messageBird->messages->create($message);

            return $this->redirectToRoute('success');
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
            'participantsLeft' => $participantsLeft,
        ));
    }

    /**
     * @Route("/see-ya", name="success")
     */
    public function successAction()
    {
        return $this->render('default/success.html.twig');
    }

    /**
     * @Route("/over", name="over")
     */
    public function overAction()
    {
        return $this->render('default/over.html.twig');
    }
}
