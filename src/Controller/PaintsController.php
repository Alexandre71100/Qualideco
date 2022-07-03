<?php

namespace App\Controller;

use App\Entity\Paints;
use App\Repository\PaintsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;

class PaintsController extends AbstractController
{
    #[Route('/paints', name: 'app_paints')]
    public function index(PaintsRepository $paintsRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $paints = $paginatorInterface->paginate(
            $paintsRepository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
    

        return $this->render('paints/index.html.twig', [
            'paints' => $paints
            
        ]);
    }
}
