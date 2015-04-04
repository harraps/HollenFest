<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Stage
 *
 * @ORM\Table(name="fr_stage")
 * @ORM\Entity
 */
class Stage
{
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Expose
     */
    protected $name;

    /**
     * @var array
     * 
     * @ORM\OneToMany(targetEntity="Stage", mappedBy="concerts", cascade={"persist"})
     * @Expose
     */
    protected $concerts;
    
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
     * Set name
     *
     * @param string $name
     * @return Stage
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set concerts
     * 
     * @param array $concerts
     * @return Stage
     */
    public function setConcerts($concerts)
    {
        $this->concerts = $concerts;
        return $this;
    }
    
    /**
     * Get concerts
     * 
     * @return array of Concert
     */
    public function getConcerts()
    {
        return $this->concerts;
    }
    
    /**
     * Add a concert if space is available
     * 
     * @param Concert $concert
     * @return Stage
     */
    public function addConcert(Concert $concert)
    {
        $canAdd = true;
        foreach( $this->concerts as &$c ){
            if( !$c->checkSpace($concert) ){
                $canAdd = false;
            }
        }
        if( $canAdd ){
            $this->concerts[] = $concert;
        }
        return $this;
    }
    
    /**
     * Add a concert and remove others if space isn't available
     * 
     * @param Concert $concert
     * @return Stage
     */
    public function forceAddConcert(Concert $concert)
    {
        foreach( $this->concerts as $key => &$c ){
            if( !$concert->checkSpace($c) ){
                // we have to remove the $c
                unset( $this->concerts[$key] );
            }
        }
        // we reset the indexes of the array
        $this->concerts = array_values($this->concerts);
        
        // we add the concert object
        $this->concerts[] = $concert;
        return $this;
    }
    
}
