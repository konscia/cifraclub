<?php

namespace Konscia\CifraClub;

use voku\helper\HtmlDomParser;

interface CifraClubProxyInterface
{
    /**
     * @param Slug $artist
     * @return HtmlDomParser
     * @throws ArtistaNaoEncontradoException
     */
    public function paginaArtista(Slug $artist) : HtmlDomParser;

    /**
     * @param Musica $music
     * @return HtmlDomParser
     * @throws MusicaNaoEncontradaException
     */
    public function paginaMusica(Musica $music) : HtmlDomParser;
}