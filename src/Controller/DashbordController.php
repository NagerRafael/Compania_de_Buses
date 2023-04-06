<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/dashbord')]
class DashbordController extends AbstractController
{

    #[Route('/public', name: 'app_dashbord_public')]
    public function public(): Response
    {
        return $this->render('dashbord/public/index.html.twig', [
            'controller_name' => 'DashbordController',
        ]);
    }

    #[Route('/admin', name: 'app_dashbord_admin')]
    #[IsGranted(('ROLE_SUPER_ADMIN') )]
    public function admin(): Response
    {
        return $this->render('dashbord/admin/index.html.twig', [
            'controller_name' => 'DashbordController',
        ]);
    }
}
