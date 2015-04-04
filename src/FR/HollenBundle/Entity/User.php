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
     * @var RunningOrder
     * @ORM\OneToOne(targetEntity="RunningOrder", cascade={"remove", "persist"})
     * @Expose
     */
    protected $runningOrder;


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
     * Set runningOrder
     *
     * @param \stdClass $runningOrder
     * @return User
     */
    public function setRunningOrder($runningOrder)
    {
        $this->runningOrder = $runningOrder;
        return $this;
    }

    /**
     * Get runningOrder
     *
     * @return \stdClass 
     */
    public function getRunningOrder()
    {
        return $this->runningOrder;
    }
}
