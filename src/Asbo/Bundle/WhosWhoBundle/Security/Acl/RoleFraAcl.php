<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Security\Acl;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Implements Role checking using the Symfony2 Security component.
 */
class RoleFraAcl
{
    /**
     * The current Security Context.
     *
     * @var SecurityContext
     */
    private $securityContext;

    /**
     * The role that will grant list permission for fras.
     *
     * @var string
     */
    private $listRole;

    /**
     * The role that will grant create permission for a fra.
     *
     * @var string
     */
    private $createRole;

    /**
     * The role that will grant view permission for a fra.
     *
     * @var string
     */
    private $viewRole;

    /**
     * The role that will grant edit permission for a fra.
     *
     * @var string
     */
    private $editRole;

    /**
     * The role that will grant delete permission for a fra.
     *
     * @var string
     */
    private $deleteRole;

    /**
     * The role that will grant export permission for a fra.
     *
     * @var string
     */
    private $exportRole;

    /**
     * Constructor.
     *
     * @param SecurityContext $securityContext
     * @param $listRole
     * @param string $createRole
     * @param string $viewRole
     * @param string $editRole
     * @param string $deleteRole
     */
    public function __construct(SecurityContext $securityContext,
        $listRole,
        $createRole,
        $viewRole,
        $editRole,
        $deleteRole
    )
    {
        $this->securityContext = $securityContext;
        $this->listRole = $listRole;
        $this->createRole = $createRole;
        $this->viewRole = $viewRole;
        $this->editRole = $editRole;
        $this->deleteRole = $deleteRole;
    }

    /**
     * Checks if the Security token is allowed to list fras.
     *
     * @return boolean
     */
    public function canList()
    {
        return $this->securityContext->isGranted($this->listRole);
    }

    /**
     * Checks if the Security token is allowed to export fras.
     *
     * @return boolean
     */
    public function canExport()
    {
        return $this->securityContext->isGranted($this->exportRole);
    }

    /**
     * Checks if the Security token has an appropriate role to create a new Fra.
     *
     * @return boolean
     */
    public function canCreate()
    {
        return $this->securityContext->isGranted($this->createRole);
    }

    /**
     * Checks if the Security token is allowed to view the specified Fra.
     *
     * @param  Fra     $fra
     * @return boolean
     */
    public function canView(Fra $fra)
    {
        return $this->securityContext->isGranted($this->viewRole, $fra);
    }

    /**
     * Checks if the Security token has an appropriate role to edit the supplied Fra.
     *
     * @param  Fra     $fra
     * @return boolean
     */
    public function canEdit(Fra $fra)
    {
        return $this->securityContext->isGranted($this->editRole, $fra);
    }

    /**
     * Checks if the Security token is allowed to delete a specific Fra.
     *
     * @param  Fra     $fra
     * @return boolean
     */
    public function canDelete(Fra $fra)
    {
        return $this->securityContext->isGranted($this->deleteRole, $fra);
    }
}
