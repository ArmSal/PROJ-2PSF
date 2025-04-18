<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use App\DataFixtures\AppFixtures;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(
        ArticleRepository $articleRepository,
        ContactMessageRepository $contactMessageRepository
    ): Response {
        $articles = $articleRepository->findBy([], ['createdAt' => 'DESC']);
        $messages = $contactMessageRepository->findBy([], ['createdAt' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'articles' => $articles,
            'messages' => $messages,
        ]);
    }
    #[Route('/load-fixtures', name: 'load_fixtures')]
    #[IsGranted('ROLE_ADMIN')]
    public function loadFixtures(EntityManagerInterface $entityManager): Response
    {
        $fixtures = new AppFixtures();
        $fixtures->load($entityManager);

        $this->addFlash('success', '10 articles fictifs ont été ajoutés.');

        return $this->redirectToRoute('app_admin');
    }
}
