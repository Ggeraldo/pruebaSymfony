<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'Usuario' => 'ROLE_USER',
                  'Partner' => 'ROLE_PARTNER',
                  'Administrador' => 'ROLE_ADMIN',
                ],
            ])
            ->add('password')
        ;

        $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function($roleArray){
                        return count($roleArray) ? $roleArray[0] : null;

                    },
                    function($roleString){
                        return [$roleString];
                    }
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
