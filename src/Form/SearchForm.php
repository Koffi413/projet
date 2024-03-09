<?php
namespace App\Form;

use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType; // Importer TextType
use  App\Entity\Search;
use  App\Entity\Maisons;


class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [ // Utiliser TextType::class
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Rechercher un produit...'
                ]
            ])
            ->add('Maisons', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Maisons::class,
                'expanded' => true,
                'multiple' => true,
            ])
            
            ->add('promo' , CheckboxType::class, [
                'label' => 'En promotion',
                'required' => false,
                
                
            ]) 

            ->add('min' , NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix min'
                ]
            ])

            ->add('max' , NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix max'
                ]
            ])  
            
             

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'POST',
            'csrf_protection' => false
         ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
