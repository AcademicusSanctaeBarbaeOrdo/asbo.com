<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\AdminBundle\Event;

use Asbo\Bundle\EventBundle\Model\Event;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * Event admin for SonataAdminBundle.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class EventAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    protected $parentAssociationMapping = 'calendar';

    /**
     * {@inheritDoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
        ;

        if (!$this->isChild()) {
            $formMapper->add('calendar', 'sonata_type_model_list');
        }

        $formMapper
            ->add('startsAt', 'datetime')
            ->add('endsAt', 'datetime')
            ->add('location')
            ->add('status', 'choice',
                [
                    'choices' => Event::getStatusChoices(),
                ]
            )
            ->add(
                'eventHasFras',
                'sonata_type_collection',
                [
                    'cascade_validation' => true,
                ],
                [
                    'edit'              => 'inline',
                    'inline'            => 'table',
                    'sortable'          => 'position',
                ]
            )
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('startsAt')
            ->add('endsAt')
            ->add('location')
            ->add('status')
        ;

        if (!$this->isChild()) {
            $listMapper->add('calendar');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function configureShowFields(ShowMapper $listMapper)
    {
        $listMapper
            ->add('name')
            ->add('description')
            ->add('startsAt')
            ->add('endsAt')
            ->add('location')
            ->add('status')
            ->add('eventHasFras')
        ;

        if (!$this->isChild()) {
            $listMapper->add('calendar');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance()
    {
        $now = new \DateTime();
        $tomorrow = clone $now;

        $event = parent::getNewInstance()
            ->setStartsAt($now)
            ->setEndsAt($tomorrow->add(new \DateInterval('P1D')))
        ;

        return $event;
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
            'Voir',
            ['uri' => $admin->generateUrl('show', ['id' => $id])]
        );

        $menu->addChild(
            'Éditer',
            ['uri' => $admin->generateUrl('edit', ['id' => $id])]
        );

        $menu->addChild(
            'Fras',
            ['uri' => $admin->generateUrl('asbo.event.admin.event_has_fra.list', ['id' => $id])]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $this->updateEventHasFras($object);
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $this->updateEventHasFras($object);
    }

    /**
     * @param mixed $object
     *
     * @return mixed
     */
    private function updateEventHasFras($object)
    {
        // @see bug in SonataMediaBundle\Admin\GalleryAdmin.php
        $object->setEventHasFras(iterator_to_array($object->getEventHasFras()->getIterator()));
    }
}
