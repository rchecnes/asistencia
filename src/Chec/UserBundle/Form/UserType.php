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
                'attr'          => array('class' => '','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('first_name','text',array(
                'label'         => 'Nombres',
                'attr'          => array('class' => '','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('last_name','text',array(
                'label'         => 'Apellido',
                'attr'          => array('class' => '','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('email','text',array(
                'label'         => 'Email',
                'attr'          => array('class' => '','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('password','text',array(
                'label'         => 'Password',
                'attr'          => array('class' => '','placeholder'   => ''),
                'required'      => true,
            ))
            //->add('role')
            ->add('is_active')
            ->add('create_at', 'datetime')
        ;
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
