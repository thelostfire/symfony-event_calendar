<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/important', name: 'important_category')]
    public function important(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        $eventsImportant = [];
        foreach($events as $event) {
            if($event->getCategory()->getName() === 'Important') {
                $eventsImportant[] = $event;
            }
        }
        return $this->render('category/important.html.twig', [
            'events_important' => $eventsImportant,
        ]);
    }
    #[Route('/work', name: 'work_category')]
    public function work(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        $eventsImportant = [];
        foreach($events as $event) {
            if($event->getCategory()->getName() === 'Work') {
                $eventsWork[] = $event;
            }
        }
        return $this->render('category/work.html.twig', [
            'events_work' => $eventsWork,
        ]);
    }
    #[Route('/social', name: 'social_category')]
    public function social(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        $eventsSocial = [];
        foreach($events as $event) {
            if($event->getCategory()->getName() === 'Social') {
                $eventsSocial[] = $event;
            }
        }
        return $this->render('category/social.html.twig', [
            'events_social' => $eventsSocial,
        ]);
    }
    #[Route('/home', name: 'home_category')]
    public function home(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        $eventsHome = [];
        foreach($events as $event) {
            if($event->getCategory()->getName() === 'Home') {
                $eventsHome[] = $event;
            }
        }
        return $this->render('category/home.html.twig', [
            'events_home' => $eventsHome,
        ]);
    }
    #[Route('/sport', name: 'sport_category')]
    public function sport(EventRepository $eventRepo): Response
    {
        $events = $eventRepo->findAll();
        $eventsSport = [];
        foreach($events as $event) {
            if($event->getCategory()->getName() === 'Sport') {
                $eventsSport[] = $event;
            }
        }
        return $this->render('category/sport.html.twig', [
            'events_sport' => $eventsSport,
        ]);
    }
}
