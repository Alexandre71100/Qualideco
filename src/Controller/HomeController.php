<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function search(): Response
    {

        $form = $this->createFormBuilder(null)
        ->add('label', TextType::class)
        ->add('search', SubmitType::class, [
            'attr'=> [
                'class' => 'btn btn-primary'
            ]
        ])
        ->getForm();
        return $this->render('home/index.html.twig', [
            'form'=> $form -> createView()
        ]);
    }
}
