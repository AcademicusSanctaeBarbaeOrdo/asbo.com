<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\User;

use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;

class UserAdmin extends BaseUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('email')
            ->addIdentifier('fullname')
            ->add('groups')
            ->add('enabled', null,
                [
                    'editable' => true,
                ]
            )
            ->add('locked', null,
                [
                    'editable' => true,
                ]
            )
            ->add('createdAt')
        ;

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper
                ->add('impersonating', 'string',
                    [
                        'template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig',
                    ]
                )
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->with('Social')
                ->add('githubId', null,
                    [
                        'required' => false,
                    ]
                )
                ->add('linkedinId', null,
                    [
                        'required' => false,
                    ]
            )
            ->end()
        ;
    }

}
