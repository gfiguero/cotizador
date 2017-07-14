<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class RutaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['id'];
        $builder 
            ->add('estado', null, array(
                'label' => 'ruta.form.estado',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => true,
            ))
            ->add('encuestador', null, array(
                'label' => 'ruta.form.encuestador',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'required' => false,
                'placeholder' => 'ruta.form.placeholder.encuestador',
            ))
            ->add('solicitudes', 'entity', array(
                'label' => 'ruta.form.solicitudes',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'KoreAgentBundle',
                'class' => 'KoreAdminBundle:Solicitud',
                'choice_label' => 'direccion',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (EntityRepository $er) use ($id) {
                    return $er->createQueryBuilder('s')
                        ->where('s.ruta is NULL')
                        ->orWhere('s.ruta = :id')
                        ->setParameter('id', $id)
                    ;
                },
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\AdminBundle\Entity\Ruta',
            'id'         => NULL,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_ruta';
    }


}
