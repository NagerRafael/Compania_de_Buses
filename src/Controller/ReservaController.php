<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Form\ReservaType;
use App\Repository\ReservaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reserva')]
class ReservaController extends AbstractController
{
    #[Route('/', name: 'app_reserva_index', methods: ['GET'])]
    public function index(ReservaRepository $reservaRepository): Response
    {
        return $this->render('reserva/index.html.twig', [
            'reservas' => $reservaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reserva_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservaRepository $reservaRepository): Response
    {
        $reserva = new Reserva();
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservaRepository->save($reserva, true);

            return $this->redirectToRoute('app_reserva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reserva/new.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/{idReserva}', name: 'app_reserva_show', methods: ['GET'])]
    public function show(Reserva $reserva): Response
    {
        return $this->render('reserva/show.html.twig', [
            'reserva' => $reserva,
        ]);
    }

    #[Route('/{idReserva}/edit', name: 'app_reserva_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reserva $reserva, ReservaRepository $reservaRepository): Response
    {
        $form = $this->createForm(ClienteReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservaRepository->save($reserva, true);

            return $this->redirectToRoute('app_reserva_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reserva/edit.html.twig', [
            'reserva' => $reserva,
            'form' => $form,
        ]);
    }

    #[Route('/{idReserva}', name: 'app_reserva_delete', methods: ['POST'])]
    public function delete(Request $request, Reserva $reserva, ReservaRepository $reservaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserva->getIdReserva(), $request->request->get('_token'))) {
            $reservaRepository->remove($reserva, true);
        }

        return $this->redirectToRoute('app_reserva_index', [], Response::HTTP_SEE_OTHER);
    }
}
