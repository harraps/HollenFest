<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Genre
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\Column(name="rockbands", type="array")
     */
    private $rockbands;


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
     * @return Genre
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
     * Set rockbands
     *
     * @param array $rockbands
     * @return Genre
     */
    public function setRockbands($rockbands)
    {
        $this->rockbands = $rockbands;

        return $this;
    }

    /**
     * Get rockbands
     *
     * @return array 
     */
    public function getRockbands()
    {
        return $this->rockbands;
    }
}
