<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomicilioBuscarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('buscar', null, array(
                'label' => 'domicilio.form.buscar',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_domicilio';
    }


}
