<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Date;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class EventUpdateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('time')
            ->add('description')
            ->add('eventPic', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image
                ]
            ])
            ->add('category', EntityType::class, [
                
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('date', EntityType::class, [
                'class' => Date::class,
                'choice_label' => 'id',
            ])
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
