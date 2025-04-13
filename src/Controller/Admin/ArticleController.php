<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArticleController extends AbstractController{
    #[Route('/admin/article', name: 'app_admin_article')]
    public function index(): Response
    {
        return $this->render('admin/article/index.html.twig', [
            'controller_name' => 'Admin/ArticleController',
        ]);
    }
}
