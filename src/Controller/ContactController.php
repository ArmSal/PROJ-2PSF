<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactMessageType;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactMessageType::class, $contactMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactMessage->setCreatedAt(new \DateTimeImmutable()); 



            $entityManager->persist($contactMessage);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message de contact a été envoyé avec succès.');
            return $this->redirectToRoute('app_contact', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact/index.html.twig', [
            'contact_message' => $contactMessage,
            'form' => $form,
        ]);
    }
}
