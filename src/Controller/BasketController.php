<?php

namespace App\Controller;

use App\Repository\PaintsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
    public function index(SessionInterface $session, PaintsRepository $paintsRepository): Response
    {
        $basket = $session->get('basket', []);

        $basketWithData = [];

        foreach ($basket as $id => $quantity) {
            $basketWithData[] = [
                'paints' => $paintsRepository->find($id),
                'quantity' => $quantity
            ];
        }
        $total = 0;

        foreach ($basketWithData as $item) {
            $totalItem = $item['paints']->getPrice() *  $item['quantity'];
            $total += $totalItem;
        }

        return $this->render('basket/index.html.twig', [
            'items' => $basketWithData,
            'total' => $total
        ]);
    }

    #[Route('/basket/add/{id}', name: 'app_basket_add')]
    public function add($id, SessionInterface $session)
    {


        $basket = $session->get('basket', []);

        if (!empty($basket[$id])) {
            $basket[$id]++;
        } else {
            $basket[$id] = 1;
        }

        $basket[$id] = 1;

        $session->set('basket', $basket);

        return $this->redirectToRoute("app_basket");
    }

    #[Route('/basket/remove/{id}', name: 'app_basket_remove')]
    public function remove($id, SessionInterface $session)
    {
        $basket = $session->get('basket', []);

        if (!empty($basket[$id])) {
            unset($basket[$id]);
        }
        $session->set('basket', $basket);

        return $this->redirectToRoute("app_basket");
    }
}
