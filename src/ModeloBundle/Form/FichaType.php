<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FichaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motivo', TextType::class, 
                    array(
                        "label"=>"(*)Motivo de Visita",
                        "required"=>"required",
                        "attr"=> array(
                                 "class"=>"form-group form-control"
                                 )
                        )
                )
            
//            ->add('fecha', DateType::class, 
//                    array(
//                        'widget' => 'single_text',
//                        "required"=>'required',
//                        "format" => 'yyyy-MM-dd',
//                        "attr"=> array(
//                                    "class"=>"form-control input-inline datepicker",
//                                    'data-provide' => 'datepicker',
//                                    'data-date-format' => 'yyyy-mm-dd'
//                                    )       
//                        )
//                )
            
            ->add('idsocio', EntityType::class,
                    array(
                        'label'=>'(*)Accion Socio',    
                        'class' => 'ModeloBundle:Socio',
                        'choice_label' => 'accion',
                        'multiple' => false,
                        'expanded' => false,
                        "attr"=> array(
                        "class"=>"form-group form-control"
                            )
                        )
                    )
                
            ->add('invitados', TextType::class,
                    array(
                        "mapped"=> false,
                        "label"=>"(*)Invitados Ejem: Nombre Apellido Cedula/Siguiente",
                        "required"=>"required",
                        "attr"=> array(
                                    "class"=>"form-group form-control"
                                    )
                        )
                )
                
            ->add('guardar', SubmitType::class, 
                    array(
                        "attr"=> array(
                                    "class"=>"form-group form-submit btn btn-success"
                                    )
                        )
                )     
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ModeloBundle\Entity\Ficha'
        ));
    }
}
