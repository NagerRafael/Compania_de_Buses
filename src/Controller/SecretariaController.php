<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Form\ClienteReservaType;
use App\Form\ReservaType;
use App\Repository\ReservaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecretariaController extends AbstractController
{
    #[Route('/secretaria', name: 'app_secretaria')]
    public function index(ReservaRepository $reservaRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        $reservas = $reservaRepo->findAll();
        return $this->render('secretaria/index.html.twig', [
            'lista' => $reservas,
        ]);
    }
    #[Route('/secretaria/clientes', name: 'app_secretaria_clientes')]
    public function cliente(ReservaRepository $reservaRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        $reservas = $reservaRepo->reservaclientes();
        return $this->render('secretaria/clientes.html.twig', [
            'lista' => $reservas,
        ]);
    }
    #[Route('/secretaria/infocliente/{id}', name: 'app_secretaria_infocliente')]
    public function infocliente(Usuario $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        return $this->render('secretaria/info.html.twig', [
            'usuario' => $user,
        ]);
    }

    #[Route('/secretaria/aprobar/{id}', name: 'app_secretaria_aprobar')]
    public function aprobar(Reserva $reserva,ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        $reserva->setEstadoReserva('Aprobado');
        $em = $doctrine->getManager();
        $em->persist($reserva);
        $em->flush();
        return $this->redirectToRoute('app_secretaria');
    }
    #[Route('/secretaria/denegar/{id}', name: 'app_secretaria_denegar')]
    public function denegado(Reserva $reserva,ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        $reserva->setEstadoReserva('Denegado');
        $em = $doctrine->getManager();
        $em->persist($reserva);
        $em->flush();
        return $this->redirectToRoute('app_secretaria');
    }

    #[Route('/secretaria/rechazar/{id}', name: 'app_secretaria_rechazar')]
    public function rechazar(Request $request,Reserva $reserva,ManagerRegistry $doctrine,ReservaRepository $reservaRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_SECRETARIA');
        $form = $this->createForm(ClienteReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserva->setEstadoReserva("Rechazado");
            $bus = $reserva->getIdBus();
            $bus->setEstadoBus("Disponible");
            $em = $doctrine->getManager();
            $em->persist($bus);
            $em->flush();
            $reservaRepository->save($reserva, true);
            return $this->redirectToRoute('app_secretaria_clientes');
        }
        return $this->render('reserva/edit.html.twig', [
            'reserva' => $reserva,
            'form' => $form->createView(),
        ]);
    }
}
