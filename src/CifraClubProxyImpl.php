<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Musica;
use Konscia\CifraClub\ArtistaNaoEncontradoException;
use Konscia\CifraClub\MusicaNaoEncontradaException;
use Konscia\CifraClub\Slug;
use voku\helper\HtmlDomParser;
use voku\helper\SimpleHtmlDomNodeBlank;

class CifraClubProxyImpl implements CifraClubProxyInterface
{
    public function paginaArtista(Slug $artist): HtmlDomParser
    {
        $url = $this->url($artist);
        $dom = HtmlDomParser::file_get_html($url);

        $elementWithArtistName = $dom->getElementById("span_bread");
        if ($elementWithArtistName instanceof SimpleHtmlDomNodeBlank) {
            throw new ArtistaNaoEncontradoException($artist);
        }

        return $dom;
    }

    public function paginaMusica(Musica $music): HtmlDomParser
    {
        $url = $this->url($music->getArtista()->getSlug()."/".$music->getSlug());
        $dom = HtmlDomParser::file_get_html($url);

        $elementWithMusicName = $dom->find(".cifra h1", 0);
        if ($elementWithMusicName instanceof SimpleHtmlDomNodeBlank) {
            throw new MusicaNaoEncontradaException($music);
        }

        return $dom;
    }

    private function url(string $after) : string
    {
        return "https://www.cifraclub.com.br/{$after}";
    }

}