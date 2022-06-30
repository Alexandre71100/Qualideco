<?php

namespace App\Controller;

use App\Entity\Paints;
use App\Repository\PaintsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintsController extends AbstractController
{
    #[Route('/paints', name: 'app_paints')]
    public function index(PaintsRepository $paintsRepository): Response
    {
        return $this->render('paints/index.html.twig', [
            'paints' => $paintsRepository->findAll(),
            
        ]);
    }
}
