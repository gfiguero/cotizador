<?php

namespace Kore\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'security.form.email',
                'translation_domain' => 'KoreUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('username', null, array(
                'label' => 'security.form.username',
                'translation_domain' => 'KoreUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array('translation_domain' => 'KoreUserBundle'),
                'first_options' => array('label' => 'security.form.password'),
                'second_options' => array('label' => 'security.form.password_confirmation'),
                'invalid_message' => 'security.form.password_mismatch',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('name', null, array(
                'label' => 'security.form.name',
                'translation_domain' => 'KoreUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
            ))
            ->add('account', null, array(
                'label' => 'security.form.account',
                'translation_domain' => 'KoreUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => true,
            ))
            ->add('groups', null, array(
                'label' => 'security.form.groups',
                'translation_domain' => 'KoreUserBundle',
                'attr' => array('label_col' => 4, 'widget_col' => 8),
                'required' => true,
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'kore_user_registration';
    }
}
