<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Orders;
use App\Entity\Payment;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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

            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
            ])

            ->add('transport', EntityType::class, [
                'class' => Transport::class,
                'choice_label' => 'name',

                'choice_attr' => function(Transport $transport) {
                    return ['data-transport' => $transport->getPrice()];
                }


            ])

            ->add('payment', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'name',

                'choice_attr' => function(Payment $payment) {
                    return ['data-payment' => $payment->getPrice()];
                }


            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orders::class,
        ]);
    }
}
