<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Controller of fra page
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 */
class PostController extends Controller
{
    /**
     * @Template("AsboWebBundle:Frontend/Post:last.html.twig")
     */
    public function getLastPostAction()
    {

        $posts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AsboCoreBundle:Post')
            ->findBy(
                [
                    'enabled' => true
                ],
                [
                    'publicationDateStart' => 'DESC'
                ],
                1
            );

        if (0 < count($posts)) {
            $post = $posts[0];
        } else {
            $post = null;
        }

        return [
            'post' => $post
        ];
    }
}
