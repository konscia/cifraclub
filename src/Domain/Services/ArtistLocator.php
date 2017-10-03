<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\ValueObjects\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Stash\Interfaces\PoolInterface;

class ArtistLocator
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    /**
     * @var PoolInterface
     */
    private $cache;

    public function __construct(CifraClubProxyInterface $cifraClubProxy, PoolInterface $cache)
    {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->cache = $cache;
    }

    /**
     * @param Slug $artist
     * @return Artist
     */
    public function findBySlug(Slug $artist)
    {
        $key = 'artist.'.$artist;
        $item = $this->cache->getItem($key);

        if($item->isHit()) {
            return $item->get();
        }

        $page = $this->cifraClubProxy->getArtistPage($artist);
        $artist = new Artist($artist, $page);

        $item->set($artist);
        $item->expiresAfter(new \DateInterval('P1M'));
        $this->cache->save($item);

        return $artist;
    }
}