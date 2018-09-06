<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\Artist;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Utils\TokenGenerator;

class AlbumRepository extends ServiceEntityRepository
{
    /**
     * AlbumRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    /**
     * @param $album
     * @param $artist
     * @return Album
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store($artist, $album)
    {
        $albumObj = new Album();
        $albumObj->setTitle($album->title);
        $albumObj->setCover($album->cover);
        $albumObj->setArtist($artist);
        $token = TokenGenerator::generate(6);
        $albumObj->setToken($token);
        $albumObj->setDescription($album->description);
        $this->_em->persist($albumObj);
        $this->_em->flush();
        return $albumObj;
    }

    /**
     * @param String $token
     * @return Artist
     */
    public function findByToken(String $token): ?Album
    {
        return $this->findOneBy(['token' => $token]);
    }
}
