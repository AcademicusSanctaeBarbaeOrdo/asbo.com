<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WebBundle\Behat;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Web user context.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class WebUserContext extends MinkContext implements KernelAwareInterface
{
    /**
     * Kernel.
     *
     * @var KernelInterface
     */
    private $kernel;

    /**
     * {@inheritdoc}
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Generate url.
     *
     * @param string  $route
     * @param array   $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    private function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        return $this->getService('router')->generate($route, $parameters, $absolute);
    }

    /**
     * Get service by id.
     *
     * @param string $id
     *
     * @return object
     */
    private function getService($id)
    {
        return $this->getContainer()->get($id);
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->kernel->getContainer();
    }
}
