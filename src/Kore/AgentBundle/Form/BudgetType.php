<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', null, array(
                'label' => 'budget.form.code',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('client', null, array(
                'label' => 'budget.form.client',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('seller', null, array(
                'label' => 'budget.form.seller',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('items', 'bootstrap_collection', array(
                'label' => false,
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
                'entry_type' => 'Kore\AgentBundle\Form\ItemType',
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text'    => 'budget.form.additem',
                'delete_button_text' => 'budget.form.deleteitem',
                'delete_empty' => true,
                'by_reference' => false,
            ))
            ->add('notes', null, array(
                'label' => 'budget.form.notes',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10, 'class' => 'multiselect' ),
                'translation_domain' => 'KoreAgentBundle',
                'choice_label' => function($val, $key, $index) {
                    return $val->getName();
                }
            ))
            ->add('note', null, array(
                'label' => 'budget.form.note',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10, 'class' => 'wysiwyg' ),
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
            'data_class' => 'Kore\AdminBundle\Entity\Budget'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_budget';
    }


}
