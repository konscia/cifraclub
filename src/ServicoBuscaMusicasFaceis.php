<?php

namespace Konscia\CifraClub\Aplicacao;

use Konscia\CifraClub\Domain\Services\ArtistLocator;
use Konscia\CifraClub\Domain\ValueObjects\Slug;

class ServicoBuscaMusicasFaceis
{
    /**
     * @var ArtistLocator
     */
    private $artistLocator;

    public function __construct(ArtistLocator $artistLocator)
    {
        $this->artistLocator = $artistLocator;
    }

    public function findByArtistSloganAndNumberOfChords(Slug $artist, int $maxChords)
    {
        $artistEntity = $this->artistLocator->findBySlug($artist);

        //Busca Musicas do Artista com Acordes

        //Processa para pegar com o número máximo de acordes definido

        //Ordena

        //Devolve a lista de músicas
    }
}