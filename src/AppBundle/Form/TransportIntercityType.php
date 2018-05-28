<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\TransportClass;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TransportIntercityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cityFrom', EntityType::class, [
                'label' => 'Город отбытия',
                'class' => City::class,
                'choice_label' => 'name'
            ])
            ->add('cityIn', EntityType::class, [
                'label' => 'Город прибытия',
                'class' => City::class,
                'choice_label' => 'name'
            ])
            ->add('class', EntityType::class, [
                'label' => 'Класс транспорта',
                'class' => TransportClass::class,
                'choice_label' => 'name'
            ])
            ->add('priceType', TextType::class, ['label' => 'Тип цены','required'=>false])
            ->add('price', IntegerType::class, ['label' => 'Цена'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\TransportIntercity'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_transport_intercity';
    }
}