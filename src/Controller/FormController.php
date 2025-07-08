<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventForm;
use App\Form\EventUpdateForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;

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
            $this->addFlash('success', 'Évènement bien enregistré.');

            return $this->redirectToRoute('app_index');
        }

        return $this->render('form/event.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('event/update/{id}', name: 'event-update', methods: ['GET', 'POST'])]
    public function eventUpdateForm(Request $request, Event $event, EntityManagerInterface $em): Response    
    {
        $form = $this->createForm(EventUpdateForm::class, $event);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var \Symfony\Component\HttpFoundation\File\UploadedFile $profilePic */
            $eventPic = $form->get('eventPic')->getData();

            if($eventPic) {
                $originalFilename = pathinfo($eventPic->getClientOriginalName(), PATHINFO_FILENAME);
                $slugger = new AsciiSlugger;
                $safeFilename = $slugger->slug($originalFilename);
                $filename = $safeFilename . '-' . uniqid() . '.' . $eventPic->guessExtension();

                try {
                    $eventPic->move('uploads/event/', $filename);
                    if($event->getEventPicFilename() !== null) {
                        unlink(__DIR__ . "/../../public/uploads/event/" . $event->getEventPicFilename());
                    }
                    $event->setEventPicFilename($filename);
                }
                catch(FileException $e) {
                    $form->addError(new FormError("Erreur lors de l'upload de l'image"));
                }
            }

            $em->flush();
        }

        return $this->render('form/edit.html.twig', [
            'form' => $form,
            'event' => $event
        ]);
    }
}
