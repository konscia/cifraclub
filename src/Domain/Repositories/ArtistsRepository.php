<?php

namespace Konscia\CifraClub\Domain\Repositories;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;

class ArtistsRepository
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    public function __construct(CifraClubProxyInterface $cifraClubProxy)
    {
        $this->cifraClubProxy = $cifraClubProxy;
    }

    /**
     * @param Slug $artist
     * @return Artist|null
     */
    public function findBySlug(Slug $artist)
    {
        try {
            $page = $this->cifraClubProxy->getArtistPage($artist);
        } catch (\InvalidArgumentException $e) {
            return null;
        }

        return new Artist($artist, $page);
    }
}