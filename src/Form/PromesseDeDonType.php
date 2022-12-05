<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\PromesseDeDon;
use App\Entity\User;
use App\Repository\UserRepository;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromesseDeDonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emailDonateur')
            ->add('firstName',EntityType::class, options: [
                'class'=>User::class
            ])
            ->add('lastName')
            ->add('donationAmount',IntegerType::class,[
                'required'=>true,
                'label'=>'Le montant de votre don'])
            ->add('Campagne',EntityType::class,[
                'class'=>Campagne::class,
                'choice_label'=>function($campagne){
                    return $campagne->getName();
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PromesseDeDon::class,
        ]);
    }
}
