<?php

namespace ModeloBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nombre', TextType::class, array("label"=>"(*)Nombres","required"=>"required", "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('role', ChoiceType::class, 
                array("label"=>"Perfil de Usuario","required"=>"required",
                'multiple' => false,
                'expanded' => false,
                'choices' => array( 'Administrador' => 'ROLE_USER',
                                    'Administracion' => 'ROLE_USER', 
                                    'Vigilancia' => 'ROLE_GUARD', 
                                    'Junta Directiva' => 'ROLE_DIRECTIVE',
                                    'Deportes' => 'ROLE_SPORTS'),
                "attr"=> array(
                    "class"=>"form-control"
                )))
                ->add('email',EmailType::class, array("label"=>"Correo Electronico","required"=>"required", "attr"=> array(
                "class"=>"form-control"
                )))
                ->add('password', PasswordType::class, array("label"=>"Contraseña","required"=>"required", "attr"=> array(
                "class"=>"form-control"
                )))
                ->add('idempleado', EntityType::class, array(
                'label'=>'(*)Empleado',    
                'class' => 'ModeloBundle:Empleado',
                'choice_label' => 'cedula',
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
            'data_class' => 'ModeloBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'modelobundle_usuario';
    }


}
