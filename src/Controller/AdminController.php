<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Paints;
use App\Entity\SubCategory;
use App\Form\CategoryFormType;
use App\Form\PaintsFormType;
use App\Form\SubCategoryFormType;
use App\Repository\CategoryRepository;
use App\Repository\PaintsRepository;
use App\Repository\ReservationRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * Catégorie
     */

    // Liste Catégorie
    #[Route('/category', name: 'app_category')]
    public function listingCategoty(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/category/listingCategory.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }

    // Formulaire d'ajout d'un Catégorie
    #[Route('/newCategory', name: 'app_new_category')]
    public function newCategory(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_category');
        }

        return $this->render('admin/category/newCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Edition d'une Catégorie
    #[Route('/category/edit/{id}', name: 'app_edit_category', requirements: ['id' => '\d+'])]
    public function editCategory(Category $category, Request $request, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_category');
        }

        return $this->render('admin/category/editCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/category/delete/{id}', name:'category_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deleteCategory(Category $category, Request $request, CategoryRepository $categoryRepository): RedirectResponse
    {
		// Récupère le jeton CSRF généré dans le formulaire
        $tokenCsrf = $request->request->get('token');

		// Vérifie si le jeton est correct avant d'effectuer une suppression
        if ($this->isCsrfTokenValid('delete-category-'. $category->getId(), $tokenCsrf)) {

			// Supprimer en BDD les données en lui passant l'objet de l'entité.
			// Le second paramètre est à mettre à "true", sinon les données sont seulement persistées et non supprimées.
            $categoryRepository->remove($category, true);

			// Enregistre un message flash à afficher dans le fichier Twig de votre choix
            $this->addFlash('success', 'Le catégorie à bien été supprimé');
        }

		// Redirige l'utilisateur vers une autre page selon le nom de la route
        return $this->redirectToRoute('app_category');
    }

    /**
     * Sous-Catégorie
     */

    #[Route('/subcategory', name: 'app_subCategory')]
    public function listingsubCategory(SubCategoryRepository $subCategoryRepository): Response
    {
        return $this->render('admin/subCategory/listingsubCategory.html.twig', [
            'subCategories' => $subCategoryRepository->findAll()
        ]);
    }


    #[Route('/newsubCategory', name: 'app_new_subcategory')]
    public function newsubCategory(Request $request, SubCategoryRepository $subCategoryRepository): Response
    {
        $subcategory = new SubCategory();
        $form = $this->createForm(SubCategoryFormType::class, $subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategoryRepository->add($subcategory, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_subCategory');
        }

        return $this->render('admin/subCategory/newsubCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/subcategory/edit/{id}', name: 'app_edit_subcategory', requirements: ['id' => '\d+'])]
    public function editsubCategory(SubCategory $subCategory, Request $request, SubCategoryRepository $subCategoryRepository): Response
    {
        $form = $this->createForm(SubCategoryFormType::class, $subCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subCategoryRepository->add($subCategory, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_subCategory');
        }

        return $this->render('admin/subCategory/editsubCategory.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
      * Peinture
      */

    #[Route('/paint', name: 'app_paint')]
    public function listingPaint(PaintsRepository $paintsRepository): Response
    {
        return $this->render('admin/paint/listingPaint.html.twig', [
            'paints' => $paintsRepository->findAll()
        ]);
    }

    #[Route('/newpaint', name: 'app_new_paint')]
    public function newPaint(Request $request, PaintsRepository$paintsRepository): Response
    {
        $paints = new Paints();
        $form = $this->createForm(PaintsFormType::class, $paints);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paintsRepository->add($paints, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_paint');
        }

        return $this->render('admin/paint/newPaint.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/paint/edit/{id}', name: 'app_edit_paint', requirements: ['id' => '\d+'])]
    public function editPaint(Paints $paints, Request $request, PaintsRepository $paintsRepository): Response
    {
        $form = $this->createForm(PaintsFormType::class, $paints);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $paintsRepository->add($paints, true);
            $this->addFlash('success', 'La catégorie à bien été enregistrée');

            return $this->redirectToRoute('app_paint');
        }

        return $this->render('admin/paint/editpaint.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Reservation
     */

    #[Route('/reservation', name: 'app_reservation')]
    public function listingReservation(ReservationRepository $reservationRepository): Response
    {
        return $this->render('admin/reservation/listingReservation.html.twig', [
            'reservations' => $reservationRepository->findAll()
        ]);
    }
    


}
