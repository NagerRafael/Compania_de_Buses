<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Form\RegistrationFormType;
use App\Form\ReservaType;
use App\Repository\ReservaRepository;
use App\Repository\UsuarioRepository;
use App\Security\AppAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ReservaRepository $reservasRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $reservas = $reservasRepo->findAll();
        return $this->render('admin/index.html.twig', [
            'lista' => $reservas,
        ]);
    }
    #[Route('/admin/secretarias', name: 'app_admin_secretarias')]
    public function lista(UsuarioRepository $userRepo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $secretarias = $userRepo->findBy(['tipo' => "Secretaria"]);
        return $this->render('admin/lista.html.twig', [
            'lista' => $secretarias,
        ]);
    }
    #[Route('/admin/secretaria', name: 'app_admin_secretaria')]
    public function secretaria(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user = new Usuario();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $user->setRoles([Usuario::ROLE_SECRETARIA]);
           $user->setTipo("Secretaria");
            // encode the plain password
            $user->setEstado("A");
            $user->setClave(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_admin_secretarias', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/secretaria.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/admin/reserva', name: 'app_admin_reserva', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservaRepository $reservaRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $reserva = new Reserva();
        $form = $this->createForm(ReservaType::class, $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reserva->setEstadoReserva('Creado');
            $reserva->setEstado('A');
            $reservaRepository->save($reserva, true);

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('admin/reserva.html.twig', [
            'reserva' => $reserva,
            'form' => $form->createView(),
        ]);
    }
}
