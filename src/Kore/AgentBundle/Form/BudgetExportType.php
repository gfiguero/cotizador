<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BudgetExportType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productcolumns', ChoiceType::class, array(
                'label' => 'budget.form.productcolumns',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
                'choices'  => array(
                    'name' => 'product.form.name',
                    'description' => 'product.form.description',
                    'height' => 'product.form.height',
                    'width' => 'product.form.width',
                    'length' => 'product.form.length',
                    'weight' => 'product.form.weight',
                    'cost' => 'product.form.cost',
                    'price' => 'product.form.price',
                    'imagefile' => 'product.form.imagefile',
                    'cm_code' => 'product.form.cm_code',
                    'provider' => 'product.form.provider',
                ),
                'multiple' => true,
                'expanded' => true,
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_budgetexport';
    }

}
