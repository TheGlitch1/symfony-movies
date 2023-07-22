<?php

namespace App\Form;

use App\Entity\Movie; // use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType; //TODO :Always import this when editing the $builder and want to use TextType class
use Symfony\Component\Form\Extension\Core\Type\IntegerType; //TODO :Always import this when editing the $builder and want to use TextType class
use Symfony\Component\Form\Extension\Core\Type\TextareaType; //TODO :Always import this when editing the $builder and want to use TextType class
use Symfony\Component\Form\Extension\Core\Type\FileType; //TODO :Always import this when editing the $builder and want to use TextType class

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr'=> array(
                    'class'=>'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none',
                    'placeholder'=>'Enter title ...'
                ),
                'label' => false
            ])
            ->add('releaseYear',IntegerType::class, [
                'attr'=> array(
                    'class'=>'bg-transparent block mt-10 border-b-2 w-full h-20 text-6xl outline-none',
                    'placeholder'=>'Enter releaseYear ...'
                ),
                'label' => false
            ])
            ->add('description', TextareaType::class, [
                'attr'=> array(
                    'class'=>'bg-transparent block border-b-2 w-full h-20 text-6xl outline-none',
                    'placeholder'=>'Enter Description ...'
                ),
                'label' => false
            ])
            ->add('imagePath',FileType::class ,[
                'attr' => [
                    'class' => 'py-10 block mt-10 --border-b-2 --w-full --h-60 --text-6xl --outline-none'
                ],
                //fto make this also work for Edit we need to add two properties :
                    //mapped & required 
                'mapped' => false, //means we dont want to associate this field with entity properties
                'required' => false, //means we wont be needing it when editing
                'label' => false,

            ])

            // ->add('actors')
            // ->add('cinemas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
