<?php

namespace Konscia\CifraClub\Domain\Factories;

use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\Entities\Music;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use voku\helper\HtmlDomParser;

class ArtistFactory
{
    public function createFromSlugAndHtmlCifraClub(Slug $artistSlug, HtmlDomParser $html)
    {
        $name = $html->getElementById("span_bread")->innerHtml;
        $artist = new Artist($artistSlug, $name);

        $musicLinks = $html->find('ol.list-links.art_musics.all a.art_music-link');
        $musics = [];
        foreach ($musicLinks as $link) {
            $url = $link->getAttribute('href');

            if(strstr($url, "#") or strstr($url, "letra")) {
                continue; //ignore it isnt a musci
            }

            $urlSlices = explode("/", trim($url, "/"));
            $slug = $urlSlices[1];

            $musics[] = new Music($artist, new Slug($slug), $link->innerHtml());
        }

        $artist->setMusics($musics);

        return $artist;
    }
}