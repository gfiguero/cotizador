<?php

namespace Kore\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraintsOptions = array(
            'message' => 'security.form.invalid_current_password',
        );

        if (!empty($options['validation_groups'])) {
            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
        }

        $builder->add('current_password', PasswordType::class, array(
            'label' => 'security.form.current_password',
            'translation_domain' => 'KoreUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword($constraintsOptions),
        ));

        $builder->add('plainPassword', RepeatedType::class, array(
            'type' => PasswordType::class,
            'options' => array('translation_domain' => 'KoreUserBundle'),
            'first_options' => array('label' => 'security.form.new_password'),
            'second_options' => array('label' => 'security.form.new_password_confirmation'),
            'invalid_message' => 'security.form.mismatch_password',
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ChangePasswordFormType';
    }

    public function getBlockPrefix()
    {
        return 'kore_user_change_password';
    }
}
