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
    
    // minimal amount of minutes between begin and end of the concert
    const MINTIME = 20;
    
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
    public function setRockband(RockBand $rockband)
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
     * Set both begin and end times and make sure that there is atleast 20min between them
     * 
     * @return Concert
     */
    public function setTimes(DateTime $beginTime, DateTime $endTime )
    {
        $diff = $beginTime->diff( $endTime )->getTimestamp();
        
        // if the interval is not negative
        if( !$diff->invert ){
            if( $this->MINTIME <= ( $diff->i + 60*( $diff->h + 24*$diff->d ) ) ){
                $this->beginTime = $beginTime;
                $this->endTime = $endTime;
            }
        }
        return $this;
    }
    
    /**
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return Concert
     */
    public function setBeginTime(DateTime $beginTime)
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
     * return the begin time as an int with 1 = 1min
     * @return int
     */
    public function beginint()
    {
        return (int)($this->beginTime->getTimestamp()/60);
    }
    
    /**
     * return the begin time as an int with a margin of 20 min
     * @return int
     */
    public function beginintmargin()
    {
        return (int)($this->beginTime->getTimestamp()/60) - $this->MINTIME;
    }
    
    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return Concert
     */
    public function setEndTime(DateTime $endTime)
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
    
    /**
     * return the end time as an int with 1 = 1min
     * @return int
     */
    public function endint()
    {
        return (int)($this->endTime->getTimestamp()/60);
    }
    
    /**
     * return the end time as an int with a margin of 20 min
     * @return int
     */
    public function endintmargin()
    {
        return (int)($this->endTime->getTimestamp()/60) + $this->MINTIME;
    }
    
    /**
     * return true if the concert doesn't use the same space
     * @param Concert $concert
     */
    public function checkSpace(Concert $concert)
    {
        if(
            (
                $this->beginint() > $concert->beginintmargin() &&
                $this->endint()   > $concert->beginintmargin()
            )||(
                $this->beginint() < $concert->endintmargin() &&
                $this->endint()   < $concert->endintmargin()
            )
        ){
            return true;
        }
        return false;
    }
    
}
