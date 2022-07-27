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
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository,PaintsRepository $paintsRepository , PaginatorInterface $paginatorInterface ,Request $request): Response
    {

        $id = $request->query->get("id");
        $category = $categoryRepository->findBy(['paints' => $id]);
        $paints = $paintsRepository->findBy(['category' =>  $id]);

        if ($id) {
            $idcategory = $categoryRepository->find($id);
        }  else {
            $paints = $paginatorInterface->paginate(
                $paintsRepository->findBy(['category' => $id]),
                $request->query->getInt('page', 1),
                10
            );
        }
        return $this->render('category/index.html.twig', [
            'category' => $category,
            'paints'   => $paints,
        ]);
    }
}
