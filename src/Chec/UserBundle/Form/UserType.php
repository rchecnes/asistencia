<?php

namespace Chec\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_name','text',array(
                'label'         => 'Nombre de Usuario',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('first_name','text',array(
                'label'         => 'Nombres',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('last_name','text',array(
                'label'         => 'Apellido',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('email','text',array(
                'label'         => 'Email',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('password','password',array(
                'label'         => 'Contraseña',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('password_veri','password',array(
                'label'         => 'Repetir Contraseña',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
                'mapped'        => false,
                'required'      => true
            ))
            ->add('is_active','checkbox',array(
                'label'         => 'Estado',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('rol', 'entity', array(
                'attr'          => array('class' => 'form-control'),
                'class'         => 'ChecUserBundle:Rol',
                'label'         => 'Rol',
                'empty_value'   => 'Seleccionar',
                'required'      => true           
            ))
            ->add('url_image','file',array(
                'label'         => 'Imagen',
                'attr'          => array('class' => 'form-control','placeholder'   => 'Buscar Imagen'),
                //'required'      => true,
            ));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Chec\UserBundle\Entity\User'
        ));
    }
}
