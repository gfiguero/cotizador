<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolicitudAccionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('descripcion', null, array(
                'label' => 'solicitudaccion.form.descripcion',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
            )) 
            ->add('solicitud', null, array(
                'label' => 'solicitudaccion.form.solicitud',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\AdminBundle\Entity\SolicitudAccion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_solicitudaccion';
    }


}
