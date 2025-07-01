<?php

namespace App\Controller;

use App\Entity\Date;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(EntityManagerInterface $entityManager): Response 
    {
        $dates = $entityManager->getRepository(Date::class)->findAll();
        return $this->render('index/index.html.twig', [
            'dates' => $dates
        ]);
    }
    /*
    Préférer un typage fort (avec une injection de dépendance) avec un DateRepository $dateRpository à la place.
    
    public function index(DateRepository $dateRepository): Response 
    {
        $dates = $dateRepository->findAll();
        return $this->render('index/index.html.twig', [
            'dates' => $dates
        ]);
    }
    */ 
    #[Route('/daily-events/{id}', name:'app_dailies')]
    public function dailyEvents(EntityManagerInterface $entityManager, int $id): Response{
        $day = $entityManager->getRepository(Date::class)->find($id);
        return $this->render('index/dailies.html.twig', [
            'day' => $day
        ]);
    }
}
