<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
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
     * @ORM\Column(name="runningOrder", type="object")
     */
    private $runningOrder;


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
