<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Paints;
use App\Repository\CategoryRepository;
use App\Repository\PaintsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category', requirements: ['id' => '\d+'])]
    public function index(PaginatorInterface $paginatorInterface,CategoryRepository $categoryRepository, PaintsRepository $paintsRepository, Request $request): Response
    {
        $category = $paginatorInterface->paginate(
            $idcategory = $categoryRepository->findAll('id'),
            $request->query->getInt('page', 1),
            $request->query->getInt('numbers', 7)
        );

      
    

        return $this->render('category/index.html.twig', [
            'categorys' => $categoryRepository->findAll(),
            
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_id', requirements: ['id' => '\d+'])]
    public function category($id = null, PaginatorInterface $paginatorInterface,PaintsRepository $paintsRepository, Request $request): Response
    {
        
        $paints = $paginatorInterface->paginate(
            $idtest = $paintsRepository->findBy(array('category' => $id)),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('category/categorie.html.twig', [
            'paints' => $paints
        ]);
    }
}