<?php

namespace FR\HollenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Rockband
 *
 * @ORM\Table(name="fr_rockband")
 * @ORM\Entity
 */
class Rockband
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Expose
     */
    private $name;

    /**
     * @var array
     *
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="rockbands", cascade={"persist"})
     * @ORM\JoinTable(name="fr_genres_rockbands")
     * @Expose
     */
    private $genres;


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
     * @return Rockband
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
     * Set genres
     *
     * @param array $genres
     * @return Rockband
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;

        return $this;
    }

    /**
     * Get genres
     *
     * @return array 
     */
    public function getGenres()
    {
        return $this->genres;
    }
}
