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
            6
        );
    

        return $this->render('paints/index.html.twig', [
            'paints' => $paints
            
        ]);
    }

    #[Route('/paints/{id}', name: 'ficheproduit_paints', requirements:['id' => '\d+'])]
    public function details(paints $paints): Response
    {
		/**
		 * Grâce à l'injection de dépendance et à l'ID passée en paramètre de la requête, Doctrine effectue la
		 * sélection en BDD de manière automatique. Si l'ID est inexistant, une erreur 404 est retournée.
		 */

        return $this->render('paints/ficheproduitpaints.html.twig', [
            'paints' => $paints
        ]);
    }
}


