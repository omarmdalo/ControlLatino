<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AsociadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres', TextType::class, array("label"=>"(*)Nombres","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('apellidos', TextType::class, array("label"=>"(*)Apellidos","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('cedula', TextType::class, array("label"=>"(*)Cedula Identidad","required"=>"required", "attr"=> array(
                "class"=>"form-group form-control"
            )))
                /*
            ->add('codigo', TextType::class,
                    array("label"=>"Codigo Barras",
                        "required"=>"required",
                        "attr"=> array(
                        "class"=>"form-group form-control"
            )))
                */               
            ->add('solvente', ChoiceType::class, 
            array("label"=>"Estado de Ingreso","required"=>"required",
            'multiple' => false,
            'expanded' => false,
            'choices' => array('Habilitado' => true, 'Deshabilitado' => false),
            "attr"=> array(
                "class"=>"form-group form-control"
            )))
            ->add('imagen', FileType::class,  array(                
                "label"=>"Imagen de Perfil",
                "data_class" => null,
                "required" => false,
                "attr"=> array(
                "type"=>"file",
                "class"=>"form-group form-control"    
                    
            )))
            ->add('idsocio', EntityType::class, array(
            'label'=>'(*)Accion',    
            'class' => 'ModeloBundle:Socio',
            'choice_label' => 'accion',
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
            'data_class' => 'ModeloBundle\Entity\Asociado'
        ));
    }
}
