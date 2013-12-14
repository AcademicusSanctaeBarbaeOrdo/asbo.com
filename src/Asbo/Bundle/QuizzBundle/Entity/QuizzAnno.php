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

use Asbo\Bundle\WhosWhoBundle\Validator\Anno;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * QuizzAnno entity
 *
 * @ORM\Table(name="quizz__anno")
 * @ORM\Entity(repositoryClass="Asbo\Bundle\QuizzBundle\Doctrine\QuizzAnnoRepository")
 * @UniqueEntity(
 *      fields={"quizz", "anno"},
 *      message="Une seule interrogation de ce type peut avoir lieu par anno."
 * )
 */
class QuizzAnno
{
    /**
     * The default weighting
     */
    const DEFAULT_WEIGHTING = 20;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer")
     * @Assert\Type(type="integer")
     * @Anno()
     */
    private $anno;

    /**
     * @var Quizz $quizz
     *
     * @ORM\ManyToOne(targetEntity="Asbo\Bundle\QuizzBundle\Entity\Quizz")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     * @Assert\Valid()
     */
    private $quizz;

    /**
     * @var integer
     *
     * @ORM\Column(name="weighting", type="integer")
     * @Assert\GreaterThanOrEqual(
     *     value = 10
     * )
     */
    private $weighting;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\Date()
     */
    private $date;

    /**
     * @var QuizzAnnoHasFra[] $quizzAnnoHasFras
     *
     * @ORM\OneToMany(targetEntity="Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra", mappedBy="quizzAnno", cascade={"all"}, orphanRemoval=true)
     * @Assert\Valid()
     * @ORM\OrderBy({"points" = "DESC"})
     */
    private $quizzAnnoHasFras;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->quizzAnnoHasFras = new ArrayCollection();
    }

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
     * @param  integer   $anno
     * @return QuizzAnno
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set weighting
     *
     * @param  integer   $weighting
     * @return QuizzAnno
     */
    public function setWeighting($weighting)
    {
        $this->weighting = $weighting;

        return $this;
    }

    /**
     * Get weighting
     *
     * @return integer
     */
    public function getWeighting()
    {
        return $this->weighting;
    }

    /**
     * Set date
     *
     * @param  \DateTime $date
     * @return QuizzAnno
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param array $quizzAnnoHasFras
     * @return $this
     */
    public function setQuizzAnnoHasFras($quizzAnnoHasFras)
    {
        $this->quizzAnnoHasFras = new ArrayCollection();

        foreach ($quizzAnnoHasFras as $quizzAnnoHasFra) {
            $this->addQuizzAnnoHasFras($quizzAnnoHasFra);
        }

        return $this;
    }

    /**
     * @return \Asbo\Bundle\QuizzBundle\Entity\QuizzAnnoHasFra[]
     */
    public function getQuizzAnnoHasFras()
    {
        return $this->quizzAnnoHasFras;
    }

    /**
     * @param QuizzAnnoHasFra $quizzAnnoHasFra
     * @return $this
     */
    public function addQuizzAnnoHasFras(QuizzAnnoHasFra $quizzAnnoHasFra)
    {
        $quizzAnnoHasFra->setQuizzAnno($this);

        $this->quizzAnnoHasFras->add($quizzAnnoHasFra);

        return $this;
    }

    /**
     * @return \Asbo\Bundle\QuizzBundle\Entity\Quizz
     */
    public function getQuizz()
    {
        return $this->quizz;
    }

    /**
     * @param \Asbo\Bundle\QuizzBundle\Entity\Quizz $quizz
     */
    public function setQuizz($quizz)
    {
        $this->quizz = $quizz;
    }

    /**
     * Return the average of this quizz.
     *
     * @param  null|integer $weighting
     * @return float
     */
    public function getAverageOfWeighting($weighting = null)
    {
        $total = 0;
        $count = count($this->getQuizzAnnoHasFras());
        $weighting = ($weighting) ?: $this->getWeighting();

        foreach ($this->getQuizzAnnoHasFras() as $quizz) {
            $total += $quizz->getPoints();
        }

        if (0 === $count) {
            return null;
        }

        return round($total/($count*$this->getWeighting())*$weighting, 2);
    }

    /**
     * Return the average of this quizz on 20.
     *
     * @return float
     */
    public function getDefaultAverage()
    {
        return $this->getAverageOfWeighting(self::DEFAULT_WEIGHTING);
    }

    /**
     * __toString method.
     */
    public function __tostring()
    {
        $string = [];

        if (null !== $this->getQuizz()) {
            $string[] = $this->getQuizz()->getTitle();
        }

        if (null !== $this->getAnno()) {
            $string[] = 'Anno '.$this->getAnno();
        }

        return implode(' - ',$string);
    }
}
