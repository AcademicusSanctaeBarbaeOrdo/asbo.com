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

use Asbo\Bundle\WhosWhoBundle\Doctrine\EntityRepository;
use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * Global variables.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class GlobalVariables
{
    /**
     * The security context.
     *
     * @var SecurityContextInterface
     */
    protected $securityContext;

    /**
     * The user variables.
     *
     * @var UserVariables
     */
    protected $userGlobal;

    /**
     * The fraHasUser repository.
     *
     * @var EntityRepository
     */
    protected $fraHasUserRepository;

    /**
     * @var Fra|string|null $fra
     */
    private $fra;

    /**
     * Constructor.
     *
     * @param SecurityContextInterface $securityContext
     * @param EntityRepository         $fraHasUserRepository
     * @param UserVariables            $userGlobal
     */
    public function __construct(SecurityContextInterface $securityContext, EntityRepository $fraHasUserRepository, UserVariables $userGlobal = null)
    {
        $this->securityContext = $securityContext;
        $this->userGlobal = $userGlobal;
        $this->fraHasUserRepository = $fraHasUserRepository;
    }

    /**
     * Return the global user variable and usefull methods.
     *
     * @throws \Exception
     * @return UserVariables
     */
    public function getUser()
    {
        if (null === $this->userGlobal) {
            throw new \Exception('Le bundle AsboUser ne semble pas être installé.');
        }

        return $this->userGlobal;
    }

    /**
     * Get the current fra.
     *
     * @return Fra|null
     */
    public function getFra()
    {
        if (null === $this->fra) {

            if (null === $token = $this->securityContext->getToken()) {

                $this->fra = 'none';

                return null;
            }

            if (!is_object($user = $token->getUser())) {

                $this->fra = 'none';

                return null;
            }

            try {
                $fraHasUser = $this->fraHasUserRepository->findOneBy(['user' => $user, 'owner' => true]);
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
