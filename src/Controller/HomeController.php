<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PaintsRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PaintsRepository $paintsRepository,  Request $request): Response
    {
       
        $paints = $paintsRepository->findall(106);
           
        return $this->render('home/index.html.twig', [
            'paints' => $paints
            
        ]);
    }
}
