<?php

namespace App\Form;

use App\Entity\Orders;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('products')
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('phone')
            ->add('street')
            ->add('city')
            ->add('zipcode')
            ->add('totalPrice')
            ->add('status')
            ->add('country')
            ->add('transport')
            ->add('payment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
