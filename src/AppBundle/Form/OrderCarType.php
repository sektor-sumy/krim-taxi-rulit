<?php

namespace AppBundle\Form;

use AppBundle\Entity\TransportClass;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class OrderCarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('car', EntityType::class, ['label' => 'Автомобиль', 'class' => TransportClass::class, 'choice_label' => 'name'])
            ->add('name', TextType::class, ['label' => 'Ваше имя'])
            ->add('phone', TextType::class, ['label' => 'Ваш телефон'])
            ->add('text', TextareaType::class, ['label' => 'Комментарий к заказу'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\OrderCar'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_ordercar';
    }
}