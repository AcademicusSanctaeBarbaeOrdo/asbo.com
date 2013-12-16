<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * AsboWhosWhoExtension.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class AsboWhosWhoExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($this->getAlias());
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('form.xml');
        $loader->load('validators.xml');
        $loader->load('comite.xml');
        $loader->load('roles.xml');

        // Resources
        $loader->load('fra.xml');
        $loader->load('address.xml');
        $loader->load('phone.xml');
        $loader->load('diploma.xml');
        $loader->load('rank.xml');
        $loader->load('job.xml');
        $loader->load('email.xml');
        $loader->load('fraHasPost.xml');
        $loader->load('fraHasUser.xml');
        $loader->load('externalPost.xml');

        $container->setParameter('asbo_whoswho.security.role.list', $config['role']['list']);
        $container->setParameter('asbo_whoswho.security.role.create', $config['role']['create']);
        $container->setParameter('asbo_whoswho.security.role.view', $config['role']['view']);
        $container->setParameter('asbo_whoswho.security.role.edit', $config['role']['edit']);
        $container->setParameter('asbo_whoswho.security.role.delete', $config['role']['delete']);
        $container->setParameter('asbo_whoswho.security.role.export', $config['role']['export']);

        $container->setParameter('asbo_whoswho.nb_fra_last_login', $config['nb_fra_last_login']);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'asbo_whoswho';
    }
}
