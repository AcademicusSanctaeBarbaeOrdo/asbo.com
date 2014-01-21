<?php

namespace Sonata\NewsBundle\Admin;


namespace Asbo\Bundle\AdminBundle\News;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\NewsBundle\Admin\PostAdmin as BasePostAdmin;

class PostAdmin extends BasePostAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }
}