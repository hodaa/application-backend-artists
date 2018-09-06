<?php

namespace App\Service;

use App\Entity\Artist;
use App\Repository\ArtistRepository;

class ArtistService
{

    private $artistRepository;

    /**
     * ArtistService constructor.
     * @param ArtistRepository $artistRepository
     */
    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @return array
     */
    public function findAll(): array
    {
        return $this->artistRepository->findAll();

    }

    /**
     * @param $token
     * @return Artist|null
     */
    public function findByToken($token): ?Artist
    {
        return $this->artistRepository->findByToken($token);

    }

    /**
     * @param Artist $artist
     * @return array
     */
    function getArtistData(Artist $artist): array
    {
        $result = [];
        $result["name"] = $artist->getName();
        $result["token"] = $artist->getToken();
        return $result;
    }

    /**
     * @param Artist $artist
     * @return array
     */
    function getArtistAlbums(Artist $artist)
    {
        $albums = [];
        if ($artist->getAlbums()) {
            foreach ($artist->getAlbums() as $album) {

                $albums[] = [
                    "title" => $album->getTitle(),
                    "cover" => $album->getCover(),
                    "token" => $album->getToken()
                ];

            }
        }
        return $albums;
    }
}