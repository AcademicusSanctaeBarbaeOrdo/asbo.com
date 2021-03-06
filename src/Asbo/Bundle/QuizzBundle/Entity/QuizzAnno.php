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
     * Get id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set anno of quizz.
     *
     * @param integer $anno
     *
     * @return self
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;

        return $this;
    }

    /**
     * Get anno of quizz.
     *
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set weighting of quizz.
     *
     * @param integer $weighting
     *
     * @return self
     */
    public function setWeighting($weighting)
    {
        $this->weighting = $weighting;

        return $this;
    }

    /**
     * Get weighting of quizz.
     *
     * @return integer
     */
    public function getWeighting()
    {
        return $this->weighting;
    }

    /**
     * Set date of quizz.
     *
     * @param \DateTime $date
     *
     * @return self
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date of quizz.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Sets linked fras to quizz.
     *
     * @param array $quizzAnnoHasFras
     *
     * @return self
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
     * Get linked fras of quizz.
     *
     * @return QuizzAnnoHasFra[]
     */
    public function getQuizzAnnoHasFras()
    {
        return $this->quizzAnnoHasFras;
    }

    /**
     * Add linked fra to quizz.
     *
     * @param QuizzAnnoHasFra $quizzAnnoHasFra
     *
     * @return self
     */
    public function addQuizzAnnoHasFras(QuizzAnnoHasFra $quizzAnnoHasFra)
    {
        $quizzAnnoHasFra->setQuizzAnno($this);

        $this->quizzAnnoHasFras->add($quizzAnnoHasFra);

        return $this;
    }

    /**
     * Get quizz.
     *
     * @return Quizz
     */
    public function getQuizz()
    {
        return $this->quizz;
    }

    /**
     * Set quizz.
     *
     * @param Quizz $quizz
     *
     * @return self
     */
    public function setQuizz(Quizz $quizz)
    {
        $this->quizz = $quizz;

        return $this;
    }

    /**
     * Return the average of this quizz.
     *
     * @param null|integer $weighting
     *
     * @return float
     */
    public function getAverageOfWeighting($weighting = null)
    {
        $count = count($this->getQuizzAnnoHasFras());

        if (0 === $count) {
            return null;
        }

        $total = 0;
        $weighting = ($weighting) ?: $this->weighting;

        foreach ($this->quizzAnnoHasFras as $quizz) {
            $total += $quizz->getPoints();
        }

        return round($total/($count*$this->weighting)*$weighting, 2);
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
