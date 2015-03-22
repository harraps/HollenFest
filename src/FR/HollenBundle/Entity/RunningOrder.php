<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RunningOrder
 *
 * @ORM\Table()
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
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="concerts", type="array")
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
