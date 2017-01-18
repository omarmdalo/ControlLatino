<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DisciplinaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array("label"=>"(*)Nombre Disciplina","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('descripcion', TextType::class, array("label"=>"(*)Descripcion","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('lugar', ChoiceType::class, 
            array("label"=>"Lugar","required"=>"required",
            'multiple' => false,
            'expanded' => false,
            'choices' => array( 
                'Cancha Softbol' => 'Cancha Softbol',
                'Cancha Beisbol' => 'Cancha Beisbol',
                'Cancha Bolas Criollas' => 'Cancha Bolas Criollas',
                'Cancha Baloncesto' => 'Cancha Baloncesto',
                'Cancha Futbol Sala' => 'Cancha Futbol Sala',
                'Piscina' => 'Piscina',
                'Otro' => 'Otro'
                ),          
            "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('guardar', SubmitType::class, array("attr"=> array(
            "class"=>"form-group form-control btn btn-success"
            )))     
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModeloBundle\Entity\Disciplina'
        ));
    }
}
