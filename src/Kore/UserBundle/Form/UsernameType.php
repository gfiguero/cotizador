<?php

namespace Kore\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UsernameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\UsernameFormType';
    }

    public function getBlockPrefix()
    {
        return 'kore_user_username';
    }
}
