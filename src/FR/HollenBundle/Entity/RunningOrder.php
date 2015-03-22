<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * RunningOrder
 *
 * @ORM\Table(name="fr_runningorder")
 * @ORM\Entity
 */
class RunningOrder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="Concert", mappedBy="runningorder", cascade={"persist"})
     * @Expose
     */
    private $concerts;


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
     * Set concerts
     *
     * @param array $concerts
     * @return RunningOrder
     */
    public function setConcerts($concerts)
    {
        $this->concerts = $concerts;

        return $this;
    }

    /**
     * Get concerts
     *
     * @return array 
     */
    public function getConcerts()
    {
        return $this->concerts;
    }
}
