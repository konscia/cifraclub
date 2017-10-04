<?php

namespace Konscia\CifraClub\Domain\Factories;

use Konscia\CifraClub\Domain\ValueObjects\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;

class ArtistFactory
{
    public function createFromSlugAndHtmlCifraClub(Slug $artist, HtmlDomParser $html)
    {
        $name = $html->getElementById("span_bread")->innerHtml;
        return new Artist($artist, $name);
    }
}