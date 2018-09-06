<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\Song;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class SongRepository extends ServiceEntityRepository
{
    function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);

    }

    /**
     * @param $albumObj
     * @param $song
     * @return Song
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
     public function store($albumObj, $song): Song
    {
        $songObj = new Song();
        $songObj->setAlbum($albumObj);
        $songObj->setTitle($song->title);
        $songObj->setLength(strtotime("1970-01-01 00:$song->length UTC"));
        $this->_em->persist($songObj);
        $this->_em->flush();
        return $songObj;
    }

}