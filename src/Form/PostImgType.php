<?php

namespace App\Form;

use App\Entity\PostImg;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostImgType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('titulo', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ingrese el titulo de la imagen',
                    'class' => 'custom_class'
                ]
            ])
            ->add('descripcion', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Ingrese descripción'
                ]
            ])
            ->add('uri_img', FileType::class, [
                'mapped' => false,
                'label' => '¡Selecciona tu Imagen!'
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
