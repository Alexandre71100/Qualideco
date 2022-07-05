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
use Knp\Component\Pager\PaginatorInterface;


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
    public function listingCategoty(CategoryRepository $categoryRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $categories = $paginatorInterface->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('admin/category/listingCategory.html.twig', [
            'categories' => $categories
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
    public function listingsubCategory(SubCategoryRepository $subCategoryRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {

        $subCategories = $paginatorInterface->paginate(
            $subCategoryRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/subCategory/listingsubCategory.html.twig', [
            'subCategories' => $subCategories
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

    #[Route('/subCategory/delete/{id}', name:'subCategory_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deletesubCategory(SubCategory $subCategory, Request $request, SubCategoryRepository $subCategoryRepository): RedirectResponse
    {
		// Récupère le jeton CSRF généré dans le formulaire
        $tokenCsrf = $request->request->get('token');

		// Vérifie si le jeton est correct avant d'effectuer une suppression
        if ($this->isCsrfTokenValid('delete-subCategory-'. $subCategory->getId(), $tokenCsrf)) {

			// Supprimer en BDD les données en lui passant l'objet de l'entité.
			// Le second paramètre est à mettre à "true", sinon les données sont seulement persistées et non supprimées.
            $subCategoryRepository->remove($subCategory, true);

			// Enregistre un message flash à afficher dans le fichier Twig de votre choix
            $this->addFlash('success', 'La sous catégorie à bien été supprimé');
        }

		// Redirige l'utilisateur vers une autre page selon le nom de la route
        return $this->redirectToRoute('app_subCategory');
    }

     /**
      * Peinture
      */

    #[Route('/paint', name: 'app_paint')]
    public function listingPaint(PaintsRepository $paintsRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {

        $paints = $paginatorInterface->paginate(
            $paintsRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/paint/listingPaint.html.twig', [
            'paints' => $paints
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

    #[Route('/paints/{id}', name: 'details_paints', requirements:['id' => '\d+'])]
    public function details(Paints $paints): Response
    {
		/**
		 * Grâce à l'injection de dépendance et à l'ID passée en paramètre de la requête, Doctrine effectue la
		 * sélection en BDD de manière automatique. Si l'ID est inexistant, une erreur 404 est retournée.
		 */

        return $this->render('admin/paint/detailspaint.html.twig', [
            'paints' => $paints
        ]);
    }


    #[Route('/paint/delete/{id}', name:'paint_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function deletePaint(Paints $paints, Request $request, PaintsRepository $paintsRepository): RedirectResponse
    {
		// Récupère le jeton CSRF généré dans le formulaire
        $tokenCsrf = $request->request->get('token');

		// Vérifie si le jeton est correct avant d'effectuer une suppression
        if ($this->isCsrfTokenValid('delete-paint-'. $paints->getId(), $tokenCsrf)) {

			// Supprimer en BDD les données en lui passant l'objet de l'entité.
			// Le second paramètre est à mettre à "true", sinon les données sont seulement persistées et non supprimées.
            $paintsRepository->remove($paints, true);

			// Enregistre un message flash à afficher dans le fichier Twig de votre choix
            $this->addFlash('success', 'La peinture à bien été supprimé');
        }

		// Redirige l'utilisateur vers une autre page selon le nom de la route
        return $this->redirectToRoute('app_paint');
    }

    /**
     * Reservation
     */

    #[Route('/reservation', name: 'app_reservation')]
    public function listingReservation(ReservationRepository $reservationRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {

        $reservations = $paginatorInterface->paginate(
            $reservationRepository->findAll(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('admin/reservation/listingReservation.html.twig', [
            'reservations' => $reservations
        ]);
    }
    


}
