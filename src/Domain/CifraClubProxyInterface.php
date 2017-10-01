<?php

namespace Konscia\CifraClub\Domain;

use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;

interface CifraClubProxyInterface
{
    public function getArtistPage(Slug $artist) : HtmlDomParser;
}