<?php

namespace App\Form;

use App\Entity\PostImg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PostCsvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            // ->add('titulo', TextType::class, [
            //     'attr' => [
            //         'placeholder' => 'Ingrese el titulo de la imagen',
            //         'class' => 'custom_class'
            //     ]
            // ])
            // ->add('descripcion', TextareaType::class, [
            //     'attr' => [
            //         'placeholder' => 'Ingrese descripción'
            //     ]
            // ])
            ->add('csv', FileType::class, [
                'mapped' => false,
                'label' => '¡Selecciona el archivo csv!'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

        $resolver->setDefaults([
            'data_class' => PostImg::class,
        ]);
    }
}
