<?php

namespace App\Form;

use App\Entity\Entity;
use App\Entity\User;
use App\Entity\Weapon;
use App\Repository\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('race')
            ->add('class')
            ->add('personnalGoals')
            ->add('story')
            ->add('personality')
            ->add('advantages')
            ->add('penalty')
            ->add('hp')
            ->add('strength')
            ->add('dexterity')
            ->add('constitution')
            ->add('intelligence')
            ->add('wisdom')
            ->add('charisma')
            ->add('mana');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entity::class,
        ]);
    }
}
