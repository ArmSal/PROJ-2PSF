<?php

namespace App\Form;

use App\Entity\ContactMessage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ContactMessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le nom ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'max' => 40,
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'L\'email ne peut pas être vide.',
                    ]),
                    new Assert\Email([
                        'message' => 'L\'adresse email n\'est pas valide.',
                    ]),
                ],
            ])
            ->add('sujet', TextType::class, [
                'label' => 'Sujet',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le sujet ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'max' => 100,
                        'maxMessage' => 'Le sujet ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le message ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'Le message doit contenir au moins {{ limit }} caractères.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}
