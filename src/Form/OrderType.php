<?php

namespace App\Form;


use App\Entity\Country;
use App\Entity\Order;
use App\Entity\Payment;
use App\Entity\Transport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('telefon')
            ->add('jmeno')
            ->add('prijmeni')
            ->add('ulice')
            ->add('cp')
            ->add('mesto')
            ->add('psc')
            ->add('poznamka')
            ->add('ks')
            ->add('zeme', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
                'expanded' => true,
            ])
            ->add('doprava', EntityType::class, [
                'class' => Transport::class,
                'choice_label' => 'name',
                'expanded' => true,
            ])
            ->add('platba', EntityType::class, [
                'class' => Payment::class,
                'choice_label' => 'name',
                'expanded' => true,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}