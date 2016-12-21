<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array("label"=>"Nombre y Apellido","required"=>"required", "attr"=> array(
                "class"=>"form-name form-control"
            )))
            ->add('email', EmailType::class, array("label"=>"Correo Electronico","required"=>"required", "attr"=> array(
                "class"=>"form-email form-control"
            )))
            ->add('password', PasswordType::class, array("label"=>"Contraseña","required"=>"required", "attr"=> array(
                "class"=>"form-password form-control"
            )))
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
            'data_class' => 'ModeloBundle\Entity\Usuario'
        ));
    }
}
