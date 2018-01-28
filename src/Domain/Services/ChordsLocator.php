<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Entities\Music;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Stash\Interfaces\PoolInterface;

/**
 * Localiza os Acordes de Músicas
 *
 * Class ChordsLocator
 * @package Konscia\CifraClub\Domain\Services
 */
class ChordsLocator
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    /**
     * @var PoolInterface
     */
    private $cache;

    public function __construct(
        CifraClubProxyInterface $cifraClubProxy,
        PoolInterface $cache
    ) {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->cache = $cache;
    }

    public function findByMusic(Music $music) : Artist
    {
        $key = "artist.{$music->getArtist()->getSlug()}.music.".$music->getSlug();
        $item = $this->cache->getItem($key);

        if($item->isHit()) {
            return $item->get();
        }

        $page = $this->cifraClubProxy->getMusicPage($music);
        exit;

        $item->set($chords);
        $item->expiresAfter(new \DateInterval('P1M'));
        $this->cache->save($item);

        return $artist;
    }
}