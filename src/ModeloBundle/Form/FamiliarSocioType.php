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

class FamiliarSocioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombres', TextType::class, array("label"=>"(*)Nombres","required"=>"required", "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('apellidos', TextType::class, array("label"=>"(*)Apellidos","required"=>"required", "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('cedula', TextType::class, array("label"=>"(*)Cedula Identidad","required"=>"required", "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('nacimiento', DateType::class, 
                    array(
                        "label"=>"(*) Fecha de Nacimiento",
                        'widget' => 'single_text',
                        "required"=>'required',
                        "format" => 'yyyy-MM-dd',
                        "attr"=> array(
                                    "class"=>"form-control input-inline datepicker",
                                    'data-provide' => 'datepicker',
                                    'data-date-format' => 'yyyy-mm-dd'
                                    
                            )))              
                ->add('imagen', FileType::class,  array(                
                    "label"=>"Imagen de Perfil",
                    "data_class" => null,
                    "required" => false,
                    "attr"=> array(
                    "type"=>"file",
                    "class"=>"form-control"    

                )))
                ->add('old', TextType::class, array("label"=>"Codigo Carnet Anterior","required"=>false,'empty_data'=>null , "attr"=> array(
                    "class"=>"form-control"
                )))               
                ->add('solvente', ChoiceType::class, 
                array("label"=>"Estado de Ingreso","required"=>"required",
                'multiple' => false,
                'expanded' => false,
                'choices' => array('Habilitado' => true, 'Deshabilitado' => false),
                "attr"=> array(
                    "class"=>"form-control"
                )))
                
                ->add('idsocio', EntityType::class, array(
                'label'=>'(*)Accion',    
                'class' => 'ModeloBundle:Socio',
                'choice_label' => 'accion',
                'multiple' => false,
                'expanded' => false,
                "attr"=> array(
                    "class"=>"form-control"
                )))
                
                ->add('idtipofamiliar', EntityType::class, array(
                'label'=>'(*)Tipo de familiar',    
                'class' => 'ModeloBundle:Tipofamiliar',
                'choice_label' => 'nombre',
                'multiple' => false,
                'expanded' => false,
                "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('guardar', SubmitType::class, array("attr"=> array(
                "class"=>"form-control btn btn-success"
                ))) 
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModeloBundle\Entity\Familiar'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelobundle_familiar';
    }


}
