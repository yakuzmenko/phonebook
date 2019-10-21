<?php

namespace App\Controller;

use App\Entity\Phonebook;
use App\Form\PhonebookType;
use App\Repository\PhonebookRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/phonebook")
 */
class PhonebookController extends AbstractController
{
    /**
     * @Route("/", name="phonebook_index", methods={"GET"})
     */
    public function index(
        PhonebookRepository $phonebookRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $phonebook = new Phonebook();
        $form = $this->createForm(PhonebookType::class, $phonebook);

        $queryBuilder = $phonebookRepository->findAllQueryBuilder();

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('phonebook/index.html.twig', [
            'pagination' => $pagination,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="phonebook_new", methods={"GET", "POST"})
     */
    public function new(Request $request): Response
    {
        $phonebook = new Phonebook();
        $form = $this->createForm(PhonebookType::class, $phonebook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($phonebook);
            $entityManager->flush();

            $this->addFlash('success', 'Phone record successfully created!');

            return $this->redirectToRoute('phonebook_index');
        }

        return $this->render('phonebook/new.html.twig', [
            'phonebook' => $phonebook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="phonebook_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Phonebook $phonebook): Response
    {
        $form = $this->createForm(PhonebookType::class, $phonebook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Phone record successfully updated!');

            return $this->redirectToRoute('phonebook_index');
        }

        return $this->render('phonebook/edit.html.twig', [
            'phonebook' => $phonebook,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="phonebook_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Phonebook $phonebook): Response
    {
        if (!$this->isCsrfTokenValid('delete'.$phonebook->getId(), $request->request->get('_token'))) {
            $this->addFlash('error', 'Not valid token provided.');

            return $this->redirectToRoute('phonebook_index');
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($phonebook);
        $entityManager->flush();

        $this->addFlash('success', 'Phone record successfully deleted!');

        return $this->redirectToRoute('phonebook_index');
    }
}
