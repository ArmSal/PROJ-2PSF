<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Contenu',
                'attr' => ['class' => 'form-control', 'rows' => 6]
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'mapped' => true,
                'required' => false,
                'attr' => ['class' => 'form-control'],
                'help' => 'Si vous voulez changer l\'image, choisissez un nouveau fichier.'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

