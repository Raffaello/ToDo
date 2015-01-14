<?php

namespace ToDo\Bundle\ToDoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TodoitemsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $userid = $options['id'];
        $builder
            
            ->add('status')
            ->add('description')
            ->add('duedate')
            ->add('userid','entity', array(
                'class'         => 'ToDoToDoBundle:User',
                'property'      => 'id',
                'required'      => true,
                'empty_value'   => false,
                'label'                   => 'UserId',
                'query_builder'           => function(EntityRepository $er) use($userid)
                    {
                        return $er->qbfindById($id);
                    }
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ToDo\Bundle\ToDoBundle\Entity\Todoitems',
            'id'   => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'todo_bundle_todobundle_todoitems';
    }
}
