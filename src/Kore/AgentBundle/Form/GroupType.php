<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'group.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('predefined_note', null, array(
                'label' => 'group.form.predefined_note',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8, 'class' => 'wysiwyg' ),
                'translation_domain' => 'KoreAgentBundle',
            ))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\AdminBundle\Entity\Group'
        ));
    }

    public function getBlockPrefix()
    {
        return 'kore_agentbundle_group';
    }


}
