<?php

namespace App\Controller;

use App\Entity\Date;
use App\Repository\DateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    
    
    
    #[Route('/', name: 'app_index')]
    public function index(DateRepository $dateRepository): Response 
    {
        $dates = $dateRepository->findAll();
        return $this->render('index/index.html.twig', [
            'dates' => $dates
        ]);
    }
    
    #[Route('/daily-events/{id}', name:'app_dailies')]
    public function dailyEvents(DateRepository $dateRepository, int $id = 0): Response{
        $day = $dateRepository->find($id);
        return $this->render('index/dailies.html.twig', [
            'day' => $day
        ]);
    }
    /*
    #[Route('/daily-events/{id}', name:'app_dailies')]
    public function dailyEvents(Date $date): Response{
        $day = $date;
        return $this->render('index/dailies.html.twig', [
            'day' => $day
        ]);
    }
    */ 
}
