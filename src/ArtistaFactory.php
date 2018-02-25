<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Artista;
use Konscia\CifraClub\Musica;
use Konscia\CifraClub\Slug;
use voku\helper\HtmlDomParser;

class ArtistaFactory
{
    public function criaInstanciaAPartirDoSlugEdoHtml(HtmlDomParser $html, Slug $artistSlug)
    {
        $nome = $html->getElementById("span_bread")->innerHtml;
        $artista = new Artista($artistSlug, $nome);

        $musicas = $this->criaInstanciasMusicasAPartirHtml($html, $artista);

        $artista->setMusicas($musicas);

        return $artista;
    }

    private function criaInstanciasMusicasAPartirHtml(HtmlDomParser $html, Artista $artist): array
    {
        $musicLinks = $html->find('ol.list-links.art_musics.all a.art_music-link');
        $musicas = [];
        foreach ($musicLinks as $link) {
            $url = $link->getAttribute('href');

            if (strstr($url, "#") or strstr($url, "letra")) {
                //As urls capturadas com a expressão acima não são todas de cifras
                //Algumas tem apenas o símbolo de hash "#" e outras são links de letra
                //Nesses casos, ignora o ítem
                continue;
            }

            $nomeMusica = $link->innerHtml();
            $urlSlices = explode("/", trim($url, "/"));
            $slug = $urlSlices[1];

            $musicas[] = new Musica($artist, new Slug($slug), $nomeMusica);
        }

        return $musicas;
    }
}