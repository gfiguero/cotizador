<?php

namespace Kore\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('short', null, array(
                'label' => 'product.form.short',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('description', null, array(
                'label' => 'product.form.description',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('image', null, array(
                'label' => 'product.form.image',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('cost', null, array(
                'label' => 'product.form.cost',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('price', null, array(
                'label' => 'product.form.price',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('upc', null, array(
                'label' => 'product.form.upc',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('cm_code', null, array(
                'label' => 'product.form.cm_code',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('height', null, array(
                'label' => 'product.form.height',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('width', null, array(
                'label' => 'product.form.width',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('length', null, array(
                'label' => 'product.form.length',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('weight', null, array(
                'label' => 'product.form.weight',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('brand', null, array(
                'label' => 'product.form.brand',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('origin', null, array(
                'label' => 'product.form.origin',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('resistance', null, array(
                'label' => 'product.form.resistance',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('warranty', null, array(
                'label' => 'product.form.warranty',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('certification', null, array(
                'label' => 'product.form.certification',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('consumer_name', null, array(
                'label' => 'product.form.consumer_name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('consumer_age', null, array(
                'label' => 'product.form.consumer_age',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('consumer_capacity', null, array(
                'label' => 'product.form.consumer_capacity',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_main', null, array(
                'label' => 'product.form.structure_main',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_side', null, array(
                'label' => 'product.form.structure_side',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_instalation', null, array(
                'label' => 'product.form.structure_instalation',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_assembly', null, array(
                'label' => 'product.form.structure_assembly',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_protection', null, array(
                'label' => 'product.form.structure_protection',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_termination', null, array(
                'label' => 'product.form.structure_termination',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_color', null, array(
                'label' => 'product.form.structure_color',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('structure_size', null, array(
                'label' => 'product.form.structure_size',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('provider', null, array(
                'label' => 'product.form.provider',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('user', null, array(
                'label' => 'product.form.user',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
            )) 
            ->add('group', null, array(
                'label' => 'product.form.group',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAdminBundle',
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
        return 'kore_adminbundle_product';
    }


}
