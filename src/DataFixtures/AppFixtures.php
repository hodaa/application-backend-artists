<?php

// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Utils\TokenGenerator;
use App\Entity\Album;
use App\Entity\Song;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $url = "https://gist.githubusercontent.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe/raw/8d61579f7d0b32ba128ffbf1481e03f4f6722e17/artist-albums.json";

        $homepage = file_get_contents($url);
        $data = json_decode($homepage);

        foreach ($data as $item) {
            $artist = new Artist();
            $token =TokenGenerator::generate(6);
            $artist->setName($item->name);
            $artist->setToken($token);
            $manager->persist($artist);
            $manager->flush();
            foreach ($item->albums as $album){
                $albumObj = new Album();
                $albumObj->setTitle($album->title);
                $albumObj->setCover($album->cover);
                $albumObj->setArtist($artist);
                $token =TokenGenerator::generate(6);
                $albumObj->setToken($token);
                $albumObj->setDescription($album->description);
                $manager->persist($albumObj);
                $manager->flush();

                foreach ($album->songs as $song){
                    $songObj = new Song();
                    $songObj->setAlbum($albumObj);
                    $songObj->setTitle($song->title);
                    $songObj->setLength(strtotime("1970-01-01 00:$song->length UTC"));
                    $manager->persist($songObj);
                    $manager->flush();

                }
            }
        }
       
    }
}