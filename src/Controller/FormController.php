<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FormController extends AbstractController
{
    #[Route('/event-form', name: 'event_form', methods: ["GET", "POST"])]
    public function eventForm(Request $request, EntityManagerInterface $em): Response
    {
        $eventForm = new Event();
        $form = $this->createForm(EventForm::class, $eventForm);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($eventForm);
            $em->flush();
        }

        return $this->render('form/event.html.twig', [
            'form' => $form
        ]);
    }
}
