<?php

namespace Konscia\CifraClub\Application;

use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\Repositories\ArtistsRepository;
use Konscia\CifraClub\Domain\ValueObjects\Slug;

class EasyMusicFinder
{
    /**
     * @var ArtistsRepository
     */
    private $artistsRepository;

    public function __construct(ArtistsRepository $artistsRepository)
    {
        $this->artistsRepository = $artistsRepository;
    }

    public function findByArtistSloganAndNumberOfChords(Slug $artist, int $maxChords)
    {
        $artistEntity = $this->artistsRepository->findBySlug($artist);
        if ($artistEntity === null) {
            throw new ArtistNotFound($artist);
        }

        //Busca Musicas do Artista com Acordes

        //Processa para pegar com o número máximo de acordes definido

        //Ordena

        //Devolve a lista de músicas
    }

}