<?php

/*
 * This file is part of the Doctrine Fixtures Bundle
 *
 * The code was originally distributed inside the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 * (c) Doctrine Project
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\MigrationBundle\Command;

use InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader as DataFixturesLoader;
use Doctrine\Bundle\DoctrineBundle\Command\DoctrineCommand;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Bundle\DoctrineBundle\Mapping\MetadataFactory;
use Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper;
use Asbo\Bundle\MigrationBundle\Command\Validators;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Load data fixtures from bundles.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Jonathan H. Wage <jonwage@gmail.com>
 */
class MigrationCommand extends DoctrineCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('asbo:migration')
            ->setDescription('Migrating data from another database exported as php array.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dialog = $this->getDialogHelper();

        if ($input->isInteractive()) {
            if (!$dialog->askConfirmation($output, $dialog->getQuestion('Do you confirm migration', 'yes', '?'), true)) {
                $output->writeln('<error>Command aborted</error>');

                return 1;
            }
        }

        /** @var $doctrine \Doctrine\Common\Persistence\ManagerRegistry */
        $doctrine = $this->getContainer()->get('doctrine');
        $em = $doctrine->getManager();

        $loader = new DataFixturesLoader($this->getContainer());
        $loader->loadFromDirectory(__DIR__.'/../DataFixtures/ORM');

        $fixtures = $loader->getFixtures();
        if (!$fixtures) {
            throw new InvalidArgumentException(
                sprintf('Could not find any fixtures to load in: %s', __DIR__.'/../Schema')
            );
        }

        /** @var $fixture \Asbo\Bundle\MigrationBundle\DataFixtures\ORM\AbstractFixture */
        foreach ($fixtures as $fixture) {

            if (!$fixture instanceof \Asbo\Bundle\MigrationBundle\DataFixtures\ORM\AbstractFixture) {
                continue;
            }

            $class = $fixture->getSchemaClassName();

            $filepath = $this->getHelper('dialog')->askAndValidate(
                $output,
                sprintf('Filepath containing the entities for migration: %s', $fixture->getSchemaClassName())."\n",
                array('Asbo\Bundle\MigrationBundle\Command\Validators', 'validateFilepath'),
                false
            );
            $filepath = realpath($filepath);

            $entities = [];
            foreach (require $filepath as $fra) {
                /** @var \Asbo\Bundle\MigrationBundle\Schema\AbstractSchema $schema */
                $schema = new $class(new OptionsResolver(), $fra);
                $entities[] = $schema->getData();
            }

            $fixture->setData($entities);
            //break;
        }

        $purger = new ORMPurger($em);
        $purger->setPurgeMode(false ? ORMPurger::PURGE_MODE_TRUNCATE : ORMPurger::PURGE_MODE_DELETE);
        $executor = new ORMExecutor($em, $purger);
        $executor->setLogger(function ($message) use ($output) {
                $output->writeln(sprintf('  <comment>></comment> <info>%s</info>', $message));
            });
        $executor->execute($fixtures, false);

        return 0;
    }

    protected function parseShortcutNotation($shortcut)
    {
        $entity = str_replace('/', '\\', $shortcut);

        if (false === $pos = strpos($entity, ':')) {
            throw new \InvalidArgumentException(sprintf('The entity name must contain a : ("%s" given, expecting something like AcmeBlogBundle:Blog/Post)', $entity));
        }

        return array(substr($entity, 0, $pos), substr($entity, $pos + 1));
    }

    protected function getEntityMetadata($entity)
    {
        $factory = new MetadataFactory($this->getContainer()->get('doctrine'));

        return $factory->getClassMetadata($entity)->getMetadata();
    }

    /**
     * @return DialogHelper|\Symfony\Component\Console\Helper\HelperInterface
     */
    protected function getDialogHelper()
    {
        $dialog = $this->getHelperSet()->get('dialog');
        if (!$dialog || get_class($dialog) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\DialogHelper') {
            $this->getHelperSet()->set($dialog = new DialogHelper());
        }

        return $dialog;
    }

}
