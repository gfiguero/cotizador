<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

use Kore\AdminBundle\Validator\Constraints\Rut;
use Kore\AdminBundle\Validator\Constraints\ExisteRut;

class PersonaExistenteBuscarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut', null, array(
                'label' => 'persona.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'constraints' => array(
                    new NotBlank(),
                    new Rut(),
                    new ExisteRut(),
                ),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_personabuscar';
    }

}
