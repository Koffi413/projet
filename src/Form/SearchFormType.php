<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Search;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('categorie', ChoiceType::class,[
            'choices' =>$options['categorie'] ,
            'choice_label' => 'nom',
        ])
        
       // ->add('promo') 

            ->add('max', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix max'
                ]
            ])
            ->add('min', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prix min'
                ]
            ])
            ->add('Search', SubmitType::class, [
                'label' => 'Search'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false,
            'categorie' => null,
        ]);
        $resolver->setAllowedTypes('categorie', ['null', 'array', 'Traversable']);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
