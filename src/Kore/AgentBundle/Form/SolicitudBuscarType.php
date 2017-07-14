<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SolicitudBuscarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            ->add('id', null, array(
                'label' => 'solicitud.form.id',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
                'constraints' => array(
                    new NotBlank(),
                ),
            )) 
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_solicitudbuscar';
    }


}
