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
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=100)
     */

    private $length;

    /**
     * @ORM\ManyToOne(targetEntity="album")
     */

    private $album;

    /**
     * @return string
     */
    function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    function getLength(): string
    {
        return $this->length;
    }

    /**
     * @param $album
     * @return Album|null
     */
    function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @param $title
     */
    function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param $length
     */
    function setLength($length)
    {
        $this->length = $length;
    }
}