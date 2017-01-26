<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EquipoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array("label"=>"(*)Nombre Equipo","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('descripcion', TextType::class, array("label"=>"(*)Descripcion","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            ))) 
            ->add('idcampeonato', EntityType::class, array(
            'label'=>'(*)Campeonato',    
            'class' => 'ModeloBundle:Campeonato',
            'choice_label' => 'nombre',
            'multiple' => false,
            'expanded' => false,
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
            'data_class' => 'ModeloBundle\Entity\Equipo'
        ));
    }
}
