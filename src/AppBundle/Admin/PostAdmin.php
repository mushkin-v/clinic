<?php
namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PostAdmin extends Admin
{
    protected $baseRouteName = 'AppBundle\Entity\Post';
    protected $baseRoutePattern = 'Post';
    protected $datagridValues = [
                '_sort_order' => 'ASC',
                '_sort_by' => 'name',
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
                    ->add('text')
                    ->add('tags');
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
                    ->add('shortDescription')
                    ->add('text', 'textarea', array('attr' => array('class' => 'wysihtml5', 'style' => 'height:500px')))
                    ->add('mainPicture', 'sonata_type_model_list', [
                            'required' => false,
                            'btn_list' => false,
                        ], [
                            'link_parameters' => [
                                    'context' => 'post',
                                    'provider' => 'sonata.media.provider.image',
                                ],
                        ])
                    ->add('tags', 'sonata_type_model',
                            array(
                                    'by_reference' => true,
                                    'multiple'     => true,
                                    'property'     => 'title',
                        ));
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
                            'context' => 'post',
                            'provider' => 'sonata.media.provider.image',
                        ],
                    ])
                    ->addIdentifier('title')
                    ->add('shortDescription');
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
                    ->add('shortDescription')
                    ->add('tags');
    }
}
