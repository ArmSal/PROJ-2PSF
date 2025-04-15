<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PolitiqueDeConfController extends AbstractController
{
    #[Route('/politique-de-conf', name: 'app_politique_de_conf')]
    public function index(): Response
    {
        return $this->render('politique_de_conf/index.html.twig', [
            'controller_name' => 'PolitiqueDeConfController',
        ]);
    }
}
