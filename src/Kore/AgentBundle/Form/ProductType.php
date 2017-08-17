<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'product.form.name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('short', null, array(
                'label' => 'product.form.short',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('description', null, array(
                'label' => 'product.form.description',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'wysiwyg' ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('imagefile', 'file', array(
                'label' => 'product.form.imagefile',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9, 'class' => 'fileinput' ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
            ))

            ->add('height', null, array(
                'label' => 'product.form.height',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('width', null, array(
                'label' => 'product.form.width',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('length', null, array(
                'label' => 'product.form.length',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('weight', null, array(
                'label' => 'product.form.weight',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))

            ->add('cost', null, array(
                'label' => 'product.form.cost',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('price', null, array(
                'label' => 'product.form.price',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('upc', null, array(
                'label' => 'product.form.upc',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('cm_code', null, array(
                'label' => 'product.form.cm_code',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))

            ->add('provider', null, array(
                'label' => 'product.form.provider',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))

            ->add('brand', null, array(
                'label' => 'product.form.brand',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('origin', null, array(
                'label' => 'product.form.origin',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('resistance', null, array(
                'label' => 'product.form.resistance',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('warranty', null, array(
                'label' => 'product.form.warranty',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('certification', null, array(
                'label' => 'product.form.certification',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))

            ->add('consumer_name', null, array(
                'label' => 'product.form.consumer_name',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('consumer_age', null, array(
                'label' => 'product.form.consumer_age',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('consumer_capacity', null, array(
                'label' => 'product.form.consumer_capacity',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))

            ->add('structure_main', null, array(
                'label' => 'product.form.structure_main',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_side', null, array(
                'label' => 'product.form.structure_side',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_instalation', null, array(
                'label' => 'product.form.structure_instalation',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_assembly', null, array(
                'label' => 'product.form.structure_assembly',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_protection', null, array(
                'label' => 'product.form.structure_protection',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_termination', null, array(
                'label' => 'product.form.structure_termination',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_color', null, array(
                'label' => 'product.form.structure_color',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('structure_size', null, array(
                'label' => 'product.form.structure_size',
                'attr'  => array( 'label_col' => 3, 'widget_col' => 9 ),
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
            'data_class' => 'Kore\AdminBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_product';
    }


}
