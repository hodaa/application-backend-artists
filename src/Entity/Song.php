<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="songs")
 */
class Song
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;

    /**
     * @ORM\Column(type="string", length=100)
     */

    public $length;

    /**
     * @ORM\ManyToOne(targetEntity="album")
     */

    public $album;

    function setAlbum($album){
        $this->album=$album;
    }

    function setTitle($title){
        $this->title=$title;
    }
    function setLength($length){
        $this->length=$length;
    }
}