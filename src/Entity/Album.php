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
     * @ORM\ManyToOne(targetEntity="artist")
     */
    public $artist;

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

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }




    public function getTitle()
    {
        return $this->title;
    }
    //Getters and Setters
}
