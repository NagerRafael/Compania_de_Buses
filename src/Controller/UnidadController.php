<?php

namespace App\Controller;

use App\Entity\Unidad;
use App\Form\UnidadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/unidad')]
class UnidadController extends AbstractController
{
    #[Route('/', name: 'app_unidad_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $unidads = $entityManager
            ->getRepository(Unidad::class)
            ->findAll();

        return $this->render('unidad/index.html.twig', [
            'unidads' => $unidads,
        ]);
    }

    #[Route('/new', name: 'app_unidad_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unidad = new Unidad();
        $form = $this->createForm(UnidadType::class, $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($unidad);
            $entityManager->flush();

            return $this->redirectToRoute('app_unidad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unidad/new.html.twig', [
            'unidad' => $unidad,
            'form' => $form,
        ]);
    }

    #[Route('/{idUnidad}', name: 'app_unidad_show', methods: ['GET'])]
    public function show(Unidad $unidad): Response
    {
        return $this->render('unidad/show.html.twig', [
            'unidad' => $unidad,
        ]);
    }

    #[Route('/{idUnidad}/edit', name: 'app_unidad_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Unidad $unidad, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UnidadType::class, $unidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_unidad_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unidad/edit.html.twig', [
            'unidad' => $unidad,
            'form' => $form,
        ]);
    }

    #[Route('/{idUnidad}', name: 'app_unidad_delete', methods: ['POST'])]
    public function delete(Request $request, Unidad $unidad, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unidad->getIdUnidad(), $request->request->get('_token'))) {
            $entityManager->remove($unidad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_unidad_index', [], Response::HTTP_SEE_OTHER);
    }
}
