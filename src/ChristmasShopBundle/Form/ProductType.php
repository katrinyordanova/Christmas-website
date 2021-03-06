<?php

namespace ChristmasShopBundle\Form;

use ChristmasShopBundle\Entity\Category;
use ChristmasShopBundle\Entity\Product;
use ChristmasShopBundle\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('data_class' => null))
            ->add('category', EntityType::class,
                ['class'=> Category::class,
                    'choice_label' => 'name',
                    'placeholder' => ''])
            ->add('price',NumberType::class, array('data_class' => null))
            ->add('isInStock',TextType::class, array('data_class' => null))
            ->add('description',TextType::class, array('data_class' => null))
            ->add('size', EntityType::class,
                ['class'=> Size::class,
                    'choice_label'=>'size',
                    'placeholder'=>''])
            ->add('image', FileType::class, array('data_class' => null))
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Product::class
        ));
    }
}
