<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class ItemType extends AbstractType
{
    private $tokenStorage;

    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $group = $this->tokenStorage->getToken()->getUser()->getGroup();
        $builder 
            ->add('product', null, array(
                'label' => false,
                'required' => true,
                'placeholder' => 'item.form.placeholder.product',
                'attr' => array( 'class' => 'multiselect' ),
                'query_builder' => function (EntityRepository $er) use ($group) {
                    return $er->createQueryBuilder('p')
                        ->where('p.group = :group')
                        ->setParameter('group', $group)
                    ;
                },
            ))
            ->add('quantity', null, array(
                'label' => false,
                'required' => true,
                'empty_data' => 1
            ))
            ->add('discount', null, array(
                'label' => false,
                'required' => true,
                'empty_data' => 0
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kore\AdminBundle\Entity\Item'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'kore_agentbundle_item';
    }


}
