<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Concert
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Concert
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
     * @var \stdClass
     *
     * @ORM\Column(name="stage", type="object")
     */
    private $stage;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="rockband", type="object")
     */
    private $rockband;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginTime", type="datetime")
     */
    private $beginTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetime")
     */
    private $endTime;


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
     * Set stage
     *
     * @param \stdClass $stage
     * @return Concert
     */
    public function setStage($stage)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return \stdClass 
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set rockband
     *
     * @param \stdClass $rockband
     * @return Concert
     */
    public function setRockband($rockband)
    {
        $this->rockband = $rockband;

        return $this;
    }

    /**
     * Get rockband
     *
     * @return \stdClass 
     */
    public function getRockband()
    {
        return $this->rockband;
    }

    /**
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return Concert
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;

        return $this;
    }

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Concert
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }
}
