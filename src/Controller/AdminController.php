<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    #[Route('/category', name: 'app_category')]
    public function listingCategoty(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/category/listingCategory.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }

    #[Route('/newCategory', name: 'app_new_category')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_admin');
        }

        return $this->render('admin/category/newCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
