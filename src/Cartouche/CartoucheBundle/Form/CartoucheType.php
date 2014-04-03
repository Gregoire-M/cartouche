<?php

namespace Cartouche\CartoucheBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CartoucheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label' => 'Nom de ma carafe'))
            ->add('url', null, array('label' => 'URL de ma carafe'))
            ->add(
                'notificationEnabled'
                , null,
                array(
                    'label' => 'Recevoir une notification par mail quand je dois changer ma cartouche',
                    'required' => false,
                )
            )
            ->add('email', null, array('label' => 'Adresse email'))
            ->add(
                'lastChangeDate',
                'date',
                array(
                    'widget' => 'single_text',
                    'input'  => 'datetime',
                    'format' => 'dd/MM/yyyy',
                    'attr'   => array('class' => 'date'),
                    'label'  => 'Dernier changement de cartouche',
                )
            )
            ->add('duration', null, array('label' => 'Durée de la cartouche (en jours)'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cartouche\CartoucheBundle\Entity\Cartouche'
        ));
    }

    public function getName()
    {
        return 'cartouche_cartouchebundle_cartouche';
    }
}
