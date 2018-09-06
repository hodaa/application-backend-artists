<?php

namespace App\Controller;

use App\Service\ArtistService;
use App\Service\AlbumService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class AlbumController extends AbstractController
{

    private $albumService;
    private $artistService;

    /**
     * AlbumController constructor.
     * @param AlbumService $albumService
     * @param ArtistService $artistService
     */
    function __construct(AlbumService  $albumService,ArtistService $artistService)
    {
        $this->albumService = $albumService;
        $this->artistService=$artistService;
    }


    /**
     * @Route("/albums/{token}")
     * @param $token
     * @return JsonResponse
     */
    public function showAlbums($token)
    {
        $album=$this->albumService->findByToken($token);

        if (!$album) {
            throw $this->createNotFoundException(
                'No Album found for  this token ' . $token
            );
        }


        $result=$this->albumService->getAlbumData($album);

        $result['artist'] = $this->artistService->getArtistData($album->getArtist());

        $result['songs'] = $this->albumService->getAlbumSongs($album);

        return new JsonResponse($result);
    }
}