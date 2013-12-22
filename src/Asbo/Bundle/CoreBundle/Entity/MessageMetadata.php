<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * Represent a MessageMetaData entity.
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @ORM\Table(name="message__message_metadata")
 * @ORM\Entity()
 */
class MessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\CoreBundle\Entity\Message", inversedBy="metadata")
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\CoreBundle\Entity\User")
     */
    protected $participant;
}
