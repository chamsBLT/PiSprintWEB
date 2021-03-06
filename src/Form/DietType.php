<?php

namespace App\Form;

use App\Entity\Diet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DietType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('breakfast')
            ->add('lunch')
            ->add('dinner')
            ->add('snacks')
            ->add('calories')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Diet::class,
        ]);
    }
}
