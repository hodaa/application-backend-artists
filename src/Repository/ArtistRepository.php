<?php

namespace App\Repository;

use App\Entity\Artist;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Utils\TokenGenerator;

class ArtistRepository extends ServiceEntityRepository
{

    /**
     * ArtistRepository constructor.
     * @param ManagerRegistry $registry
     */
    function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artist::class);

    }

    /**
     * @param $item
     * @return Artist
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store($item): Artist
    {
        $artist = new Artist();
        $token = TokenGenerator::generate(6);
        $artist->setName($item->name);
        $artist->setToken($token);
        $this->_em->persist($artist);
        $this->_em->flush();
        return $artist;
    }

    /**
     * @return array
     */
    public function findAllArtists(): array
    {
        return $this->findAll();
    }

    /**
     * @param String $token
     * @return Artist
     */
    public function findByToken(String $token): ?Artist
    {
        return $this->findOneBy(['token' => $token]);
    }
}