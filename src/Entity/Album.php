<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="albums")
 */
class Album
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    public $cover;

    /**
     * @ORM\Column(type="string", length=20,unique=true)
     */
    public $token;

    /**
     * @ORM\Column(type="text")
     */

    public $description;

    /**
     * @ORM\ManyToOne(targetEntity="Artist")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity="Song",mappedBy="songs")
     */
    private  $songs;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
    }


    /**
     *
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getToken()
    {
        return $this->token;
    }


    public function getArtist(): ?Artist
    {
        return $this->artist;
    }
    public function getSongs(): ?Song
    {
        return $this->songs;
    }

    public function setArtist($artist)
    {
        $this->artist = $artist;

    }


    public function getTitle()
    {
        return $this->title;
    }

    public function setToken($token)
    {
        $this->token=$token;
    }
    function setTitle($title)
    {
        $this->title = $title;
    }

    function setCover($cover)
    {
        $this->cover = $cover;
    }
    function setDescription($description)
    {
        $this->description = $description;
    }

}
