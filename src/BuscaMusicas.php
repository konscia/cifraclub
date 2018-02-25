<?php

namespace Konscia\CifraClub;

use Stash\Interfaces\PoolInterface;
use Stash\Item;
use voku\helper\HtmlDomParser;

class BuscaMusicas
{
    /**
     * @var PoolInterface
     */
    private $cache;

    /**
     * @var BuscaAcordes
     */
    private $buscadorAcordes;

    public function __construct(PoolInterface $cache, BuscaAcordes $buscadorAcordes)
    {
        $this->cache = $cache;
        $this->buscadorAcordes = $buscadorAcordes;
    }

    /**
     * @param $nomeArtista
     * @return Musica_old[]
     */
    public function buscaPorArtista($nomeArtista) : array
    {
        $url = "https://www.cifraclub.com.br/{$nomeArtista}";
        $item = $this->cache->getItem($nomeArtista);

        echo "Pesquisando Artista: {$url}\n";
        if ($item->isHit()) {
            return $this->ordenaMusicas($item->get());
        }

        $dom = HtmlDomParser::file_get_html($url);

        $links = $dom->find('ul.list-links.art_musics.alf.all a.art_music-link');

        $musicas = [];
        foreach ($links as $link) {
            $urlMusica = $link->getAttribute('href');

            if(strstr($urlMusica, "#") or strstr($urlMusica, "letra")) {
                echo "Descartada: {$urlMusica}\n";
                continue;
            }

            $acordes = $this->buscadorAcordes->buscaPorMusica($urlMusica);
            $musicas[] = new Musica_old($link->innerHtml, $urlMusica, $acordes);
        }

        $item->set($musicas);
        $this->cache->save($item);

        return $this->ordenaMusicas($musicas);
    }

    private function ordenaMusicas(array $musicas)
    {
        usort($musicas, function (\Konscia\CifraClub\Musica_old $a, \Konscia\CifraClub\Musica_old $b) {
            $a = $a->getAcordes()->totalAcordes();
            $b = $b->getAcordes()->totalAcordes();

            if($a === 0) {
                return 1;
            }

            if($b === 0) {
                return -1;
            }

            if ($a == $b) {
                return 0;
            }
            return ($a < $b) ? -1 : 1;
        });

        return $musicas;
    }
}