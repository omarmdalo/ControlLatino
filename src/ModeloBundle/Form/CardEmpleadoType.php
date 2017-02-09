<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CardEmpleadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('emision', DateType::class, 
                    array(
                        "label"=>"(*) Fecha de Nacimiento",
                        'widget' => 'single_text',
                        "required"=>'required',
                        "format" => 'yyyy-MM-dd',
                        "attr"=> array(
                                    "class"=>"form-control datepicker",
                                    'data-provide' => 'datepicker',
                                    'data-date-format' => 'yyyy-mm-dd'
                                    
                            )))
                ->add('vencimiento', DateType::class, 
                    array(
                        "label"=>"(*) Fecha de Nacimiento",
                        'widget' => 'single_text',
                        "required"=>'required',
                        "format" => 'yyyy-MM-dd',
                        "attr"=> array(
                                    "class"=>"form-control datepicker",
                                    'data-provide' => 'datepicker',
                                    'data-date-format' => 'yyyy-mm-dd'
                                    
                            )))
                ->add('codigo', TextType::class, array("label"=>"(*)Cedula Identidad","disabled"=>true,"required"=>"required", "attr"=> array(
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
            'data_class' => 'ModeloBundle\Entity\Empleado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelobundle_empleado';
    }


}
