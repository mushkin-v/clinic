<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use AppBundle\Entity\Category;

class CategoryAdmin extends Admin
{
    protected $baseRouteName = 'AppBundle\Entity\Category';
    protected $baseRoutePattern = 'Category';
    protected $datagridValues = [
        '_sort_order' => 'ASC',
        '_sort_by'    => 'title',
    ];

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('shortDescription')
            ->add('description')
            ->add('employees');
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('shortDescription', 'textarea', array('attr' => array('class' => 'wysihtml5', 'style' => 'height:200px')))
            ->add('description', 'textarea', array('attr' => array('class' => 'wysihtml5', 'style' => 'height:500px')))
            ->add('mainPicture', 'sonata_type_model_list', [
                'required' => false,
                'btn_list' => false,
            ], [
                'link_parameters' => [
                    'context' => 'category',
                    'provider' => 'sonata.media.provider.image',
                ],
            ])
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('mainPicture', 'sonata_type_model_list', [
                'required' => false,
                'btn_list' => false,
            ], [
                'link_parameters' => [
                    'context' => 'category',
                    'provider' => 'sonata.media.provider.image',
                ],
            ])
            ->addIdentifier('title')
//            ->addIdentifier('shortDescription')
            ->add('employees');
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('employees');
    }
}
