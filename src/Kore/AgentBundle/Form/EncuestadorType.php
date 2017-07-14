<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

use Kore\AdminBundle\Validator\Constraints\Rut;

class EncuestadorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut', null, array(
                'label' => 'encuestador.form.rut',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'constraints' => array(
                    new NotBlank(),
                    new Rut(),
                ),
            ))
            ->add('nombre', null, array(
                'label' => 'encuestador.form.nombre',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
            ))
            ->add('apellido', null, array(
                'label' => 'encuestador.form.apellido',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
            ))
            ->add('email', null, array(
                'label' => 'encuestador.form.email',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))
            ->add('celular', null, array(
                'label' => 'encuestador.form.celular',
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
            'data_class' => 'Kore\AdminBundle\Entity\Encuestador'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_encuestador';
    }

}
