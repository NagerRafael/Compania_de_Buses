<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class ErrorController extends AbstractController
{
    /**
     * @Route("/error/403")
     */
    public function error403(): Response
    {
        return $this->render('error/error403.html.twig');
    }
}