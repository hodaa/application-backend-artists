<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\ArtistService;

class ArtistController extends AbstractController
{
    private $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * Lists all Artists.
     * @Route("/artists")
     * @return JsonResponse
     */

    public function getArtist()
    {

        $artists = $this->artistService->findall();

        $artistResult = [];

        foreach ($artists as $key => $artist) {
            $artistResult[] = $this->artistService->getArtistData($artist);
            $artistResult[$key]["albums"] = $this->artistService->getArtistAlbums($artist);
        }
        return new JsonResponse($artistResult);
    }


    /**
     * @Route("/artists/{token}")
     * @param $token
     * @return JsonResponse
     */

    public function show($token)
    {

        $artist = $this->artistService->findByToken($token);

        if (!$artist) {
            throw $this->createNotFoundException(
                'No artist found for token ' . $token
            );
        }

        $result = $this->artistService->getArtistData($artist);

        $result['albums'] = $this->artistService->getArtistAlbums($artist);

        return new JsonResponse($result);
    }


}
