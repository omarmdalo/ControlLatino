<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CargoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombre', TextType::class, 
                array("label"=>"(*)Nombre",
                    "required"=>"required",
                    "attr"=> array("class"=>"form-control"
                )))
                ->add('descripcion', TextType::class, 
                array("label"=>"(*)Descripcion",
                    "required"=>"required",
                    "attr"=> array("class"=>"form-control"
                )))
                ->add('iddepartamento', EntityType::class, array(
                'label'=>'(*)Departamento',    
                'class' => 'ModeloBundle:Departamento',
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
            'data_class' => 'ModeloBundle\Entity\Cargo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelobundle_cargo';
    }


}
