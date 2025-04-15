<?php

namespace App\Controller\Admin;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/message')]
final class MessageController extends AbstractController
{
    #[Route(name: 'app_message_index', methods: ['GET'])]
    public function index(ContactMessageRepository $contactMessageRepository): Response
    {
        return $this->render('admin/message/index.html.twig', [
            'contact_messages' => $contactMessageRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_message_show', methods: ['GET'])]
    public function show(ContactMessage $contactMessage): Response
    {
        return $this->render('admin/message/show.html.twig', [
            'contact_message' => $contactMessage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_message_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactMessage $contactMessage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();
            return $this->redirectToRoute('app_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/message/edit.html.twig', [
            'contact_message' => $contactMessage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_message_delete', methods: ['POST'])]
    public function delete(Request $request, ContactMessage $contactMessage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactMessage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($contactMessage);
            $entityManager->flush();
            $this->addFlash('success', 'Le message de contact a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
