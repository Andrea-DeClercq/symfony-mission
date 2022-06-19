<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\Reponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReponseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   
        $quest = new Reponse();
        $builder
            ->add('reponse')
            ->add('utilisateur')
            ->add('date')
            //->add('idQuestion',HiddenType::class, array('data' =>'idQuestion'))
            ->add('Save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reponse::class,
        ]);
    }
}
