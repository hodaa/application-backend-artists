<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
    private $cover;

    /**
     * @ORM\Column(type="string", length=20,unique=true)
     */
    private $token;

    /**
     * @ORM\Column(type="text")
     */

    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Artist")
     */
    private $artist;

    /**
     * @ORM\OneToMany(targetEntity="Song",mappedBy="album")
     */
    private $songs;


    /**
     * Album constructor.
     */
    public function __construct()
    {
        $this->songs = new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Artist|null
     */
    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    /**
     * @return ArrayCollection
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * @param $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param $title
     */
    function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param $cover
     */
    function setCover($cover)
    {
        $this->cover = $cover;
    }

    /**
     * @param $description
     */
    function setDescription($description)
    {
        $this->description = $description;
    }

}
