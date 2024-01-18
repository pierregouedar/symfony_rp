<?php

namespace App\Form;

use App\Entity\Entity;
use App\Entity\Spell;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpellFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('damageType')
            ->add('name')
            ->add('description')
            ->add('damage')
            ->add('spellRange')
            ->add('manaAmount')
            ->add('entity', EntityType::class, [
                'class' => Entity::class,
                'choice_label' => 'firstname',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Spell::class,
        ]);
    }
}
