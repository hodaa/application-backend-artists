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

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    function getId(){
        return $this->id;
    }

    function getName(){
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    public  function  setName($name){
        $this->name=$name;
    }
    public  function  setToken($token){
        $this->token=$token;
    }




}
