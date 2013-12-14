<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Twig;

use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Global variables.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class GlobalVariables
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var /Asbo/Bundle/WhosWhoBundle/Entity/Fra $fra
     */
    protected $fra;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Return the global Who's Who variable
     *
     * @return Asbo\Bundle\WhosWhoBundle\Twig\GlobalVariables
     */
    public function getWhosWho()
    {
        if ($this->container->has('asbo.whoswho.twig.global')) {
            return $this->container->get('asbo.whoswho.twig.global');
        } else {
            throw new \Exception('Le bundle Who\'s Who ? ne semble pas être installé.');
        }
    }

    public function getUnreadMessage()
    {
        return $this->container->get('fos_message.provider')->getNbUnreadMessages();
    }

    /**
     * Return the global UserAsbo variable
     *
     * @return Asbo\Bundle\WhosWhoBundle\Twig\GlobalVariables
     */
    public function getUser()
    {
        if ($this->container->has('asbo.user.twig.global')) {
            return $this->container->get('asbo.user.twig.global');
        } else {
            throw new \Exception('Le bundle AsboUser ne semble pas être installé.');
        }
    }

    /**
     * @todo c'est super moche !
     * @return null
     */
    public function getFra()
    {
        if (null === $this->fra) {

            if (null === $token = $this->container->get('security.context')->getToken()) {

                $this->fra = 'none';

                return null;
            }

            if (!is_object($user = $token->getUser())) {

                $this->fra = 'none';

                return null;
            }

            $repository = $this->container->get('asbo_whoswho.repository.fra_has_user');

            try {
                $fraHasUser = $repository->findOneBy(['user' => $user, 'owner' => true]);
            } catch (NonUniqueResultException $e) {

                $this->fra = 'none';

                return null;
            }

            if (null === $fraHasUser) {

                $this->fra = 'none';

                return null;
            }

            $this->fra = $fraHasUser->getFra();

        }

        if ('none' === $this->fra) {
            return null;
        }

        return $this->fra;

    }
}
