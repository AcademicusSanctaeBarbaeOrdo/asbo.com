<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\WhosWhoBundle\Controller;

use Asbo\Bundle\WhosWhoBundle\Util\AnnoManipulator;
use Asbo\Bundle\WhosWhoBundle\Validator\Anno;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Asbo\Bundle\WhosWhoBundle\Model\Types\PostTypes;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller of comite page
 *
 * @author De Ron Malian <deronmalian@gmail.com>
 *
 * @method \Asbo\Bundle\WhosWhoBundle\Doctrine\FraHasPostRepository getRepository()
 */
class ComiteController extends Controller
{
    /**
     * Displays all comite.
     *
     * @Secure(roles="ROLE_WHOSWHO_USER")
     */
    public function listAction()
    {
        $types = [PostTypes::COMITE, PostTypes::CONSEIL];
        $orderBy = ['anno' => 'DESC'];

        $posts = $this->getRepository()->findByTypes($types, $orderBy);
        $postsByYears = $this->sortPostsByYear($posts);

        return $this->renderResponse(
            'list.html',
            [
                'posts' => $postsByYears
            ]
        );
    }

    /**
     * Displays a specific comite by anno.
     *
     * @Secure(roles="ROLE_WHOSWHO_USER")
     */
    public function annoAction(Request $request, $anno)
    {
        return $this->getByAnnoAndTypes($request, $anno);
    }

    /**
     * Displays current comite.
     */
    public function lastAction(Request $request)
    {
        return $this->getByAnnoAndTypes($request, AnnoManipulator::getCurrentAnno());
    }

    /**
     * Displays a specific comite by anno.
     */
    protected function getByAnnoAndTypes(Request $request, $anno, array $types = [PostTypes::COMITE, PostTypes::CONSEIL])
    {
        $anno = $this->getValidAnnoOr404($anno);
        $posts = $this->getRepository()->findByTypesAndAnno($types, $anno);

        // Lors de la phase de transition avec le synode il n'y a pas encore de comité
        // On prend le comité de l'anno précédente comme référence
        // Codexialement c'est correct ! ;-)
        if (0 === count($posts)) {

            --$anno;

            // Dans ce cas, on fait appel au controller depuis "lastAction"
            if (null === $request->attributes->get('anno')) {
                return $this->getByAnnoAndTypes($anno, $types);
            }

            // Sinon on redirige en précisiant que c'est une redirection temporaire
            return $this->redirectToRoute('asbo_whoswho_comite_anno', ['anno' => $anno], 307);
        }

        return $this->renderResponse(
            'listByAnno.html',
            [
                'posts' => $posts,
                'anno' => $anno
            ]
        );
    }

    /**
     * Returns multidimensional array where the keys are the years
     * and the values are the FraHasPost object.
     *
     * @param  \Asbo\Bundle\WhosWhoBundle\Entity\FraHasPost[] $posts
     * @return array
     */
    protected function sortPostsByYear(array $posts)
    {
        $postsByYears = [];

        foreach ($posts as $post) {
            $postsByYears[$post->getAnno()][] = $post;
        }

        return $postsByYears;
    }

    /**
     * Returns the validator service.
     *
     * @return \Symfony\Component\Validator\Validator
     */
    protected function getValidator()
    {
        return $this->get('validator');
    }

    /**
     * Valid anno or raise a not found exception.
     *
     * @param int|string $anno
     *
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return int
     */
    protected function getValidAnnoOr404($anno)
    {
        $error = $this->getValidator()->validateValue($anno, new Anno());

        if ($error->count() != 0) {
            throw $this->createNotFoundException(
                sprintf('The anno "%" doesn\'t exist.!', $anno)
            );
        }

        return (int) $anno;
    }
}
