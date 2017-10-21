<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Stash\Interfaces\PoolInterface;

class ArtistLocator
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
     * @var PoolInterface
     */
    private $cache;

    public function __construct(
        CifraClubProxyInterface $cifraClubProxy,
        ArtistFactory $factory,
        PoolInterface $cache
    ) {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->factory = $factory;
        $this->cache = $cache;
    }

    public function findBySlug(Slug $slug) : Artist
    {
        $item = $this->cache->getItem('artist.'.$slug);

        if($item->isHit()) {
            return $item->get();
        }

        $page = $this->cifraClubProxy->getArtistPage($slug);
        $artist = $this->factory->createFromSlugAndHtmlCifraClub($slug, $page);

        $item->set($artist);
        $item->expiresAfter(new \DateInterval('P1M'));
        $this->cache->save($item);

        return $artist;
    }
}