<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;

class LocalizadorDeArtista
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    /**
     * @var ArtistFactory
     */
    private $factory;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(
        CifraClubProxyInterface $cifraClubProxy,
        ArtistFactory $factory,
        Cache $cache
    ) {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->factory = $factory;
        $this->cache = $cache;
    }

    public function encontraPeloSlug(Slug $slug) : Artist
    {
        $chave = 'artist.'.$slug;

        if($this->cache->temItemEmCachePara($chave)) {
            return $this->cache->pegaItem($chave);
        }

        $page = $this->cifraClubProxy->getArtistPage($slug);
        $artist = $this->factory->createFromSlugAndHtmlCifraClub($slug, $page);

        $this->cache->salva($chave, $artist);
        return $artist;
    }
}