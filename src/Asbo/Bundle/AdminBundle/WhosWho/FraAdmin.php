<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\WhosWho;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Asbo\Bundle\WhosWhoBundle\Model\Status\FraStatus;
use Asbo\Bundle\WhosWhoBundle\Model\Types\FraTypes;
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Knp\Menu\ItemInterface as MenuItemInterface;

/**
 * Fra admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class FraAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Général')
                ->add('firstname', 'text')
                ->add('lastname', 'text')
                ->add('nickname', 'text')
                ->add('gender', 'choice',
                    [
                        'choices' => [
                            'm' => 'Homme',
                            'f' => 'Femme',
                        ],
                    ]
                )
                ->add('birthday', 'birthday',
                    [
                        'required' => false,
                    ]
                )
                ->add('birthplace', 'text',
                    [
                        'required' => false,
                    ]
                )
            ->end();

        $formMapper
            ->with('ASBO')
                ->add('anno', 'asbo_whoswho_anno',
                    [
                        'help' =>  'Date de rentrée à l\'ASBO',
                    ]
                )
                ->add('type', 'choice',
                    [
                        'choices' => FraTypes::getChoices(),
                        'help' => 'Comment le membre est-il rentré à l\'ASBO ?',
                    ]
                )
                ->add('status', 'choice',
                    [
                        'choices' => FraStatus::getChoices(),
                        'help' =>  'Quel est son status actuel ?',
                    ]
                )
                ->add('pontif', 'sonata_type_boolean',
                    [
                        'choices' => [
                            'Non',
                            'Oui',
                        ],
                        'help' => 'Le Fra est/a-t\'il été pontif ?',
                    ]
                )
                ->add('contributor')
            ->end()

            ->with('Autres')
                ->add('deathday', 'birthday',
                    [
                        'required' => false,
                    ]
                )
                ->add('deathplace', 'text',
                    [
                        'required' => false,
                    ]
                )
            ->end()
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('nickname')
            ->add('anno', null,
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => AnnoManipulator::getAnnos(),
                    ],
                ]
            )
            ->add('type', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => FraTypes::getChoices(),
                    ],
                ]
            )
            ->add('status', 'doctrine_orm_choice',
                [
                    'field_type' => 'choice',
                    'field_options' => [
                        'choices' => FraStatus::getChoices(),
                    ],
                ]
            )
            ->add('contributor', 'doctrine_orm_choice',
                [
                    'field_type' => 'checkbox',
                ]
            )
            ->add('pontif', 'doctrine_orm_choice',
                [
                    'field_type' => 'checkbox',
                ]
            )
            ->add('settings.whoswho')
            ->add('settings.pereat')
            ->add('settings.convoc_ephemerides_q1')
            ->add('settings.convoc_ephemerides_q2')
            ->add('settings.convoc_we')
            ->add('settings.convoc_banquet')
            ->add('settings.convoc_externe')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('custom', 'string',
                [
                    'template' => 'AsboAdminBundle:WhosWho:list_fra_custom_principal_image.html.twig',
                ]
            )
            ->addIdentifier('firstname')
            ->addIdentifier('lastname')
            ->addIdentifier('nickname')
            ->add('anno', null,
                [
                    'template' => 'AsboAdminBundle:WhosWho:list_anno.html.twig',
                ]
            )
            ->add('getTypeLabel', 'text',
                [
                    'sortable' => 'type',
                    'label' => 'Type',
                ]
            )
            ->add('getStatusLabel', 'text',
                [
                    'sortable' => 'type',
                    'label' => 'Status',
                ]
            )
            ->add('pontif', 'boolean',
                [
                    'editable' => true,
                ]
            )
            ->add('contributor', 'boolean',
                [
                    'editable' => true,
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('firstname')
            ->add('lastname')
            ->add('nickname')
            ->add('gender')
            ->add('principalAddress')
            ->add('bornAt')
            ->add('bornIn')
            ->add('diedAt')
            ->add('diedIn')
            ->add('anno')
            ->add('getAnnoToDates')
            ->add('getTypeLabel')
            ->add('getStatusLabel')
            ->add('pontif')
            ->add('contributor')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        $menu->addChild(
            'Voir/Editer',
            ['uri' => $admin->generateUrl('edit', ['id' => $id])]
        );

        $menu->addChild(
            'Utilisateurs liés',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.fra_has_user.list', ['id' => $id])]
        );

        $menu->addChild(
            'Emails',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.email.list', ['id' => $id])]
        );

        $menu->addChild(
            'Téléphones',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.phone.list', ['id' => $id])]
        );

        $menu->addChild(
            'Postes ASBO',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.fra_has_post.list', ['id' => $id])]
        );

        $menu->addChild(
            'Adresses',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.address.list', ['id' => $id])]
        );

        $menu->addChild(
            'Diplomes & Etudes',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.diploma.list', ['id' => $id])]
        );

        $menu->addChild(
            'Jobs',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.job.list', ['id' => $id])]
        );

        $menu->addChild(
            'Famille',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.family.list', ['id' => $id])]
        );

        $menu->addChild(
            'Titre de guindaille',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.rank.list', ['id' => $id])]
        );

        $menu->addChild(
            'Postes Extérieurs',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.externalpost.list', ['id' => $id])]
        );

        $menu->addChild(
            'Photos',
            ['uri' => $admin->generateUrl('asbo.whoswho.admin.fra_has_image.list', ['id' => $id])]
        );

        $menu->addChild(
            'Paramètres',
            [
                'uri' => $admin->generateUrl(
                        'asbo.whoswho.admin.settings.edit',
                        ['id' => $id, 'childId' => $admin->getSubject()->getSettings()->getId()]
                    )
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        $exports = parent::getExportFields();

        $exports[] = 'principalAddress';
        $exports[] = 'principalAddress.number';
        $exports[] = 'principalAddress.postcode';
        $exports[] = 'principalAddress.street';
        $exports[] = 'principalAddress.country';
        $exports[] = 'principalAddress.locality';
        $exports[] = 'principalEmail';
        $exports[] = 'principalPhone';

        return $exports;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $fra = parent::getNewInstance()
            ->setAnno(AnnoManipulator::getCurrentAnno())
        ;

        return $fra;
    }
}
