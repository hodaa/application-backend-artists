<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="artists")
 */
class Artist
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string",length=20,unique=true)
     */
    private $token;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Album", mappedBy="artist")
     *
     */
    private $albums;

    /**
     * Artist constructor.
     */
    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * @return int
     */
    function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }


}
