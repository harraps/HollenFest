<?php

namespace FR\HollenBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * User
 *
 * @ORM\Table(name="fr_user")
 * @ORM\Entity
 */
class User extends BaseUser
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
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Concert", inversedBy="concerts", cascade={"remove","persist"})
     * @ORM\JoinTable(name="fr_users_concerts")
     * @Expose
     */
    protected $concerts = array();
    
    public function setConcerts(array $concerts)
    {
        $this->concerts = $concerts;
        return $this;
    }
    
    public function getConcerts()
    {
        return $this->concerts;
    }
    
    public function addConcert(Concert $concert)
    {
        foreach( $this->concerts as $key => &$c ){
            if( !$concert->checkSpaceNoMargin($c) ){
                unset($this->concerts[$key]);
            }
        }
        $this->concerts[] = $concert;
        return $this;
    }
    
    public function removeConcert(Concert $concert)
    {
        foreach( $this->concerts as $key => &$c ){
            if( !$concert->checkSpaceNoMargin($c) ){
                unset($this->concerts[$key]);
            }
        }
        return $this;
    }
}
