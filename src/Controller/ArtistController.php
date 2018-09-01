<?php

namespace App\Controller;

use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class ArtistController extends AbstractController
{


    /**
     * Lists all Articles.
     * @Route("/artists")
     *
     * @return array
     */
    public function getArtist()
    {

        $repository = $this->getDoctrine()->getRepository(Artist::class);
        $artists = $repository->findall();


        foreach ($artists as $artist) {
            if ($artist->getAlbums()) {
                foreach ($artist->getAlbums() as $album) {

                    $artists[$artist->getId()][] = [
                        "title" => $album->getTitle(),
                        "cover" => $album->getCover(),
                        "token" => $album->getToken()];
                }
            }
        }
        return new JsonResponse($artists);
    }

    /**
     * @Route("/artists/{token}", name="product_show")
     */
    public function show($token)
    {
        $artist = $this->getDoctrine()
            ->getRepository(Artist::class)
            ->findOneBy(["token" => $token]);

        if (!$artist) {
            throw $this->createNotFoundException(
                'No artist found for token ' . $token
            );
        }
        foreach ($artist->getAlbums() as $album) {

            $albums[] = [
                "title" => $album->getTitle(),
                "cover" => $album->getCover(),
                "token" => $album->getToken()];
        }

        return new JsonResponse($albums);


    }
}