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
     * @var Stage
     * 
     * @ORM\ManyToOne(targetEntity="Stage", cascade={"persist"})
     * @Expose
     */
    protected $stage;
    
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
     * @param Rockband $rockband
     * @return Rockband
     */
    public function setRockband(RockBand $rockband)
    {
        $this->rockband = $rockband;
        return $this;
    }

    /**
     * Get rockband
     *
     * @return Rockband 
     */
    public function getRockband()
    {
        return $this->rockband;
    }

    /**
     * Set stage
     * 
     * @param  Stage $stage
     * @return Stage
     */
    public function setStage(Stage $stage)
    {
        $this->stage = $stage;
        return $this;
    }
    
    /**
     * Get stage
     * 
     * @return Stage
     */
    public function getStage()
    {
        return $this->stage;
    }
    
    /**
     * Clear space for the concert in the given array
     * 
     * @param  Concert array &$concerts
     * @return array
     */
    public function clearSpace( array &$concerts )
    {
        foreach( $concerts as $key => &$c ){
            if( !$c->checkSpace($concert) ){
                // we remove the $c
                unset( $this->concerts[$key] );
            }
        }
        return $concerts;
    }
    
    /**
     * Clear space for the concert and add it to the array
     * 
     * @param  Concert array &$concerts
     * @return array
     */
    public function clearSpaceAndAdd( array &$concerts )
    {
        $this->clearSpace($concerts);
        $concerts[] = $this;
        return $concerts;
    }
    
    /**
     * Set both begin and end times and make sure that there is atleast 20min between them
     * 
     * @return Concert
     */
    public function setTimes($beginTime, $endTime )
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
