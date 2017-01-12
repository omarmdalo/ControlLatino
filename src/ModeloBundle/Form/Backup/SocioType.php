<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SocioType extends AbstractType
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
            ->add('razonSocial', TextType::class, array("label"=>"Razon Social",'required'=> false,'empty_data'=>null , "attr"=> array(
                "class"=>"form-razon form-control"
            )))
            ->add('rif', TextType::class, array("label"=>"Registro Informacion Fiscal","required"=>false,'empty_data'=>null , "attr"=> array(
                "class"=>"form-rif form-control"
            )))                
            ->add('fecha', DateType::class, array('widget' => 'single_text', "required"=>'required', "format" => 'yyyy-MM-dd',"attr"=> array(
                "class"=>"form-control input-inline datepicker", 'data-provide' => 'datepicker', 'data-date-format' => 'yyyy-mm-dd'
            )))               
            ->add('accion',TextType::class, array("label"=>"(*)Numero de Accion","required"=>"required", "attr"=> array(
                "class"=>"form-accion form-control"
            )))
            ->add('idtiposocio', EntityType::class, array(
            'label'=>'(*)Tipo de Socio',    
            'class' => 'ModeloBundle:Tiposocio',
            'choice_label' => 'nombre',
            'multiple' => false,
            'expanded' => true
            ))    
//            ->add('idtiposocio',ChoiceType::class, array(
//                "choices"=>array(
//                    "Juridico"=> 1,
//                    "Natural"=> 2
//                ), "required"=>"required", "label"=>"(*)Tipo de Socio","attr"=> array(
//                "class"=>"form-tipo form-control"
//            )))
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
            'data_class' => 'ModeloBundle\Entity\Socio'
        ));
    }
}
