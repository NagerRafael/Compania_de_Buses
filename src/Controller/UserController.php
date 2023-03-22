<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Repository\BusRepository;
use App\Repository\ReservaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(ReservaRepository $reservaRepo): Response
    {
        $reservas = $reservaRepo->findBy(['estadoReserva'=>"Aprobado"]);
        return $this->render('user/index.html.twig', [
            'lista' => $reservas,
        ]);
    }
    #[Route('/user/reservas', name: 'app_user_lista')]
    public function reservas(ReservaRepository $reservaRepo): Response
    {
        $user = $this->getUser();
        $reservas = $reservaRepo->findBy(['idUsuario'=>$user]);
        return $this->render('user/reservas.html.twig', [
            'lista' => $reservas,
        ]);
    }

    #[Route('/user/reserva/{id}', name: 'app_user_reserva')]
    public function reserva(Reserva $reserva,ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        $reserva->setEstadoReserva('Reservado');
        $reserva->setIdUsuario($user);
        $bus = $reserva->getIdBus();
        $bus->setEstadoBus("Reservado");
        $em = $doctrine->getManager();
        $em->persist($reserva);
        $em->persist($bus);
        $em->flush();
        return $this->redirectToRoute('app_user_lista');
    }
}
