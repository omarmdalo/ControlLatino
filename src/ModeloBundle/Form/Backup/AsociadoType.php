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
                "class"=>"form-name form-control"
            )))
            ->add('apellidos', TextType::class, array("label"=>"(*)Apellidos","required"=>"required", "attr"=> array(
                "class"=>"form-surname form-control"
            )))
            ->add('cedula', TextType::class, array("label"=>"(*)Cedula Identidad","required"=>"required", "attr"=> array(
                "class"=>"form-cedula form-control"
            )))
            ->add('fecha', DateType::class, array('widget' => 'single_text', "required"=>'required', "format" => 'yyyy-MM-dd',"attr"=> array(
                "class"=>"form-control input-inline datepicker", 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd'
            )))
            ->add('idsocio', EntityType::class, array(
            'label'=>'(*)Accion',    
            'class' => 'ModeloBundle:Socio',
            'choice_label' => 'accion',
            'multiple' => false,
            'expanded' => false
            ))
            ->add('idtipoasociado', EntityType::class, array(
            'label'=>'(*)Tipo de Asociado',    
            'class' => 'ModeloBundle:Tipoasociado',
            'choice_label' => 'nombre',
            'multiple' => false,
            'expanded' => true
            ))
            ->add('guardar', SubmitType::class, array("attr"=> array(
            "class"=>"form-submit btn btn-success"
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
