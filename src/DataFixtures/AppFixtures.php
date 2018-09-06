<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Repository\AlbumRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Song;
use App\Repository\ArtistRepository;
use App\Repository\SongRepository;

class AppFixtures extends Fixture
{
    private $artistRepository;
    private $albumRepository;
    private $songRepository;

    function  __construct(ArtistRepository $artistRepository ,AlbumRepository $albumRepository,SongRepository $songRepository)
    {
        $this->artistRepository=$artistRepository;
        $this->albumRepository =$albumRepository;
        $this->songRepository =$songRepository;
    }

    public function load(ObjectManager $manager)
    {
        $url = "https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json";

        $homepage = file_get_contents($url);
        $data = json_decode($homepage);

        foreach ($data as $item) {
            $artist=$this->artistRepository->store($item);
            foreach ($item->albums as $album){
                $albumObj=$this->albumRepository->store($artist,$album);
                foreach ($album->songs as $song){
                    $this->songRepository->store($albumObj,$song);


                }
            }
        }
       
    }
}