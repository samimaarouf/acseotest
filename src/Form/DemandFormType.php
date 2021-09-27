<?php

namespace App\Form;

use App\Entity\User;
use App\Form\DataTransformer\DemandToQuestionTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;

class DemandFormType extends AbstractType
{
    private $transformer;

    public function __construct(DemandToQuestionTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('questions', TextAreaType::class, ['label' => 'Question'])
            ->add('save', SubmitType::class);

        $builder->get('questions')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
