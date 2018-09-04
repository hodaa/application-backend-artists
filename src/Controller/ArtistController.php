<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArtistController extends AbstractController
{

    /**
     * Lists all Artists.
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
    /**
     * @Route("/albums/{token}")
     */
    public function showAlbums($token)
    {
        $album= $this->getDoctrine()
            ->getRepository(Album::class)
            ->findOneBy(["token" => $token]);


        if (!$album) {
            throw $this->createNotFoundException(
                'No artist found for token ' . $token
            );
        }
//        foreach ($album->getArtist() as $artist) {
//            $artist[] = [
//                "title" => $artist->getName(),
//                "token" => $artist->getToken()
//            ];
//
//        }
//        dd($album->getSongs());
//        foreach ($album->getSongs() as $song) {
//            $artist[] = [
//                "title" => $song->geTitle(),
//                "Length" => $song->getLength()];
//
//
//        }

        return new JsonResponse($album);
    }
}
