<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Genre
 *
 * @ORM\Table(name="fr_genre")
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
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Rockband", mappedBy="genres", cascade={"persist", "merge"})
     * @Expose
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
