<?php

/*
 * This file is part of the ASBO package.
 *
 * (c) De Ron Malian <deronmalian@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asbo\Bundle\QuizzBundle\Entity;

use Asbo\Bundle\WhosWhoBundle\Entity\Fra;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * QuizzAnnoHasFra
 *
 * @ORM\Table(name="quizz__quizz_anno_has_fra")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\QuizzBundle\Doctrine\QuizzAnnoHasFraRepository")
 * @Assert\Callback(methods={"isValid"})
 * @UniqueEntity(
 *      fields={"quizzAnno", "fra"},
 *      message="Une seule interrogation de ce type peut avoir lieu par fra et par anno."
 * )
 */
class QuizzAnnoHasFra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var QuizzAnno $fra
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\QuizzBundle\Entity\QuizzAnno", inversedBy="quizzAnnoHasFras")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\Valid()
     */
    private $quizzAnno;

    /**
     * @var Fra $anno
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\WhosWhoBundle\Entity\Fra")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\Valid()
     */
    private $fra;

    /**
     * @var string
     *
     * @ORM\Column(name="points", type="float")
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     */
    private $points;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set anno
     *
     * @param  QuizzAnno       $anno
     * @return QuizzAnnoHasFra
     */
    public function setQuizzAnno(QuizzAnno $quizzAnno)
    {
        $this->quizzAnno = $quizzAnno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return QuizzAnno
     */
    public function getQuizzAnno()
    {
        return $this->quizzAnno;
    }

    /**
     * Set fra
     *
     * @param  Fra             $fra
     * @return QuizzAnnoHasFra
     */
    public function setFra(Fra $fra)
    {
        $this->fra = $fra;

        return $this;
    }

    /**
     * Get fra
     *
     * @return Fra
     */
    public function getFra()
    {
        return $this->fra;
    }

    /**
     * Set points
     *
     * @param  float           $points
     * @return QuizzAnnoHasFra
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return float
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Validate the points
     *
     * @param ExecutionContextInterface $context
     */
    public function isValid(ExecutionContextInterface $context)
    {
        if ($this->getPoints() < 0) {
            $context->addViolationAt('points', "Une note négative n'est pas autorisée.", array(), null);
        }

        if ($this->getQuizzAnno() !== null && $this->getQuizzAnno()->getWeighting() < $this->getPoints()) {
            $context->addViolationAt('points', "Une note supérieur à la pondération de l'interrogation ({{ ponderation }}) n'est pas autorisée.", ['{{ ponderation }}' => $this->getQuizzAnno()->getWeighting()], null);
        }

        if ($this->getFra() !== null && $this->getQuizzAnno() !== null && $this->getFra()->getAnno() !== $this->getQuizzAnno()->getAnno()) {
            $context->addViolationAt('points', "L'anno du fra ({{ fra }}) doit correspondre à l'anno de l'interrogation ({{ interro }}).", ['{{ fra }}' => $this->getFra()->getAnno(), '{{ interro }}' => $this->getQuizzAnno()->getAnno()], null);
        }
    }

    /**
     * __toString
     */
    public function __toString()
    {
        $string = 'Interrogation';

        if (null !== $this->getQuizzAnno()) {
            $string .= ' - '.$this->getQuizzAnno()->getQuizz()->getTitle();
        }

        if (null !== $this->getFra()) {
            $string .= ' - '.$this->getFra();
        }

        return $string;
    }
}
