<?php

namespace Konscia\CifraClub;

use voku\helper\HtmlDomParser;

class AcordesFactory
{
    public function criaInstanciaAPartirDoHtmlEDaMusica(HtmlDomParser $html, Musica $musica) : Acordes
    {
        $acordesHtml = $html->find('.cifra_cnt b');
        $acordes = [];
        foreach ($acordesHtml as $tag) {
            $acordes[] = $tag->innerHtml;
        }

        $acordesDaMusica = array_values(array_unique($acordes));

        return new Acordes($acordesDaMusica, $musica);
    }
}