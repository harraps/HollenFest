<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Concert
 *
 * @ORM\Table(name="fr_concert")
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
     * @Expose
     */
    protected $id;

    /**
     * @var Rockband
     *
     * @ORM\OneToOne(targetEntity="Rockband", cascade={"persist"})
     * @Expose
     */
    protected $rockband;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="beginTime", type="datetime")
     * @Expose
     */
    protected $beginTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endTime", type="datetime")
     * @Expose
     */
    protected $endTime;


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
