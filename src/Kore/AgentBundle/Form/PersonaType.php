<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

use Kore\AdminBundle\Validator\Constraints\Rut; 

class PersonaType extends AbstractType
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
                'disabled' => true,
            ))
            ->add('primernombre', null, array(
                'label' => 'persona.form.primernombre',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
            ))
            ->add('segundonombre', null, array(
                'label' => 'persona.form.segundonombre',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
            ->add('primerapellido', null, array(
                'label' => 'persona.form.primerapellido',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
            ))
            ->add('segundoapellido', null, array(
                'label' => 'persona.form.segundoapellido',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
            ->add('email', null, array(
                'label' => 'persona.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
            ->add('celular', null, array(
                'label' => 'persona.form.celular',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
            ->add('telefono', null, array(
                'label' => 'persona.form.telefono',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\AdminBundle\Entity\Persona'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_persona';
    }

}
