<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\TimelineBundle\Timeline;

use Asbo\Bundle\WhosWhoBundle\Doctrine\FraRepository;
use Spy\Timeline\Spread\SpreadInterface;
use Spy\Timeline\Model\ActionInterface;
use Spy\Timeline\Spread\Entry\EntryCollection;
use Spy\Timeline\Spread\Entry\EntryUnaware;

/**
 * Spread
 */
class FraResourceSpread implements SpreadInterface
{
    const FRA_CLASS = 'Asbo\Bundle\WhosWhoBundle\Entity\Fra';

    protected $supportedVerbs = [
        'asbo_whoswho.%resource%.create',
        'asbo_whoswho.%resource%.update',
        'asbo_whoswho.%resource%.delete',
        'asbo_whoswho.%resource%.principal_update'
    ];

    protected $repository;

    protected $resource;

    /**
     * Constructor.
     */
    public function __construct(FraRepository $repository, $resource)
    {
        $this->repository = $repository;
        $this->resource = $resource;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(ActionInterface $action)
    {
        return in_array($action->getVerb(), $this->getSupportedVerbsOfResource());
    }

    /**
     * {@inheritdoc}
     */
    public function process(ActionInterface $action, EntryCollection $coll)
    {
        $fras = $this->repository->findAll();

        foreach ($fras as $fra) {
            if ($fra->getId() !== $action->getComponent('target')->getData()->getFra()->getId()) {
                $coll->add(new EntryUnaware(self::FRA_CLASS, $fra->getId()), 'ASBO_WHOSWHO');
            }
        }
    }

    /**
     * Converts the supports verbs for the resource.
     *
     * @return array
     */
    protected function getSupportedVerbsOfResource()
    {
        $callback = function ($value) {
            return str_replace('%resource%', $this->resource, $value);
        };

        return array_map($callback, $this->supportedVerbs);
    }
}
