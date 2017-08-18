<?php

namespace Kore\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityRepository;

class BudgetType extends AbstractType
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
        $account = $this->tokenStorage->getToken()->getUser()->getAccount();
        $builder
            ->add('name', null, array(
                'label' => 'budget.form.name',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('client', null, array(
                'label' => 'budget.form.client',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('c')
                        ->where('c.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('issuer', null, array(
                'label' => 'budget.form.issuer',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('i')
                        ->where('i.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('seller', null, array(
                'label' => 'budget.form.seller',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('s')
                        ->where('s.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
            ))
            ->add('adjudicated_at', DateType::class, array(
                'label' => 'budget.form.adjudicatedAt',
                'attr'  => array( 'label_col' => 2, 'widget_col' => 10 ),
                'translation_domain' => 'KoreAgentBundle',
            ))
            ->add('expired_at', DateType::class, array(
                'label' => 'budget.form.expiredAt',
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
                'query_builder' => function (EntityRepository $er) use ($account) {
                    return $er->createQueryBuilder('n')
                        ->where('n.account = :account')
                        ->setParameter('account', $account)
                    ;
                },
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
