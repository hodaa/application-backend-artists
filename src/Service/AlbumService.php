<?php

namespace App\Service;

use App\Repository\AlbumRepository;

class AlbumService
{
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepository)
    {
        $this->albumRepository = $albumRepository;
    }


    /**get album by token
     * @param $token
     * @return \App\Entity\Artist
     */
    public function findByToken($token)
    {
        return $this->albumRepository->findByToken($token);
    }

    /** get details of this album
     * @param $album
     * @return array
     */
    public function getAlbumData($album)
    {
        $result = [];
        $result["title"] = $album->getTitle();
        $result["cover"] = $album->getCover();
        $result["token"] = $album->getToken();
        $result["description"] = $album->getDescription();
        return $result;
    }

    /** get songs related to this album
     * @param $album
     * @return array
     */
    public function getAlbumSongs($album)
    {
        $songs = [];
        if ($album->getSongs()) {
            foreach ($album->getSongs() as $song) {
                $songs[] = [
                    "title" => $song->getTitle(),
                    "Length" => $song->getLength()
                ];
            }
        }
        return $songs;
    }
}
