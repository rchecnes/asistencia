<?php

namespace Chec\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAnonimoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $anio = array(''=>'AÑO');
        $mes  = array(''=>'MES','1'=>'Enero','2'=>'Febrero','3'=>'Marzo','4'=>'Abril','5'=>'Mayo','6'=>'Junio','7'=>'Julio','8'=>'Agosto','9'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
        $dia  = array(''=>'DIA');

        for ($y=date('Y'); $y >=1950; $y--) { 
            $anio[$y]=$y;
        }

        for ($d=31; $d >=1; $d--) { 
            $dia[$d]=$d;
        }

        $builder
            ->add('user_name','text',array(
                'label'         => 'User Name',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('first_name','text',array(
                'label'         => 'First Name',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('last_name','text',array(
                'label'         => 'Last Name',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('email','text',array(
                'label'         => 'Email',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('password','password',array(
                'label'         => 'Password',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
            ))
            ->add('password_veri','password',array(
                'label'         => 'Repit Pasword',
                'attr'          => array('class' => 'form-control','placeholder'   => ''),
                'required'      => true,
                'mapped'        => false,
                'required'      => true
            ))
            ->add('anio','choice',array(
                'label'         => 'Repit Pasword',
                'attr'          => array('class' => 'form-control Small','placeholder'   => ''),
                'choices'=> $anio,
                'required'      => true,
                'mapped'        => false,
                'required'      => true
            ))
            ->add('mes','choice',array(
                'label'         => 'Repit Pasword',
                'attr'          => array('class' => 'form-control Small','placeholder'   => ''),
                'choices'=> $mes,
                'required'      => true,
                'mapped'        => false,
                'required'      => true
            ))
            ->add('dia','choice',array(
                'label'         => 'Repit Pasword',
                'attr'          => array('class' => 'form-control Small','placeholder'   => ''),
                'choices'=> $dia,
                'required'      => true,
                'mapped'        => false,
                'required'      => true
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
