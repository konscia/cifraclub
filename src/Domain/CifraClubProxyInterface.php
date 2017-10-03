<?php

namespace Konscia\CifraClub\Domain;

use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;

interface CifraClubProxyInterface
{
    /**
     * @param Slug $artist
     * @return HtmlDomParser
     * @throws ArtistNotFound
     */
    public function getArtistPage(Slug $artist) : HtmlDomParser;
}