<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
    public function index(): Response
    {
        return $this->render('basket/index.html.twig', [
            
        ]);
        
    }

    #[Route('/basket/add/{id}', name: 'app_basket_add')]
    public function add($id, Request $request){
        $paint = $request->$getpaint();

        $basket = $paint->get('basket' , []);

        $basket[$id] = 1;

        $paint->set('basket', $basket);

        dd($paint->get('basket'));

    }
}
