<?php

namespace Kore\FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('user', null, array(
                'label' => 'login.form.user',
                'translation_domain' => 'KoreFrontBundle',
            ))
            ->add('password', null, array(
                'label' => 'login.form.password',
                'translation_domain' => 'KoreFrontBundle',
            ))
        ;
    }
}
