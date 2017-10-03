<?php

namespace Konscia\CifraClub\Infrastructure;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;
use voku\helper\SimpleHtmlDomNodeBlank;

class CifraClubProxyImpl implements CifraClubProxyInterface
{
    public function getArtistPage(Slug $artist): HtmlDomParser
    {
        $url = $this->url($artist);
        $dom = HtmlDomParser::file_get_html($url);

        $elementWithArtistName = $dom->getElementById("span_bread");
        if ($elementWithArtistName instanceof SimpleHtmlDomNodeBlank) {
            throw new ArtistNotFound($artist);
        }

        return $dom;
    }

    private function url(string $after) : string
    {
        return "https://www.cifraclub.com.br/{$after}";
    }

}