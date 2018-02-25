<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Artista;
use Konscia\CifraClub\Musica;
use Konscia\CifraClub\MusicaNaoEncontradaException;
use Konscia\CifraClub\Slug;
use Konscia\CifraClub\ArtistaNaoEncontradoException;
use PHPUnit\Framework\TestCase;

class CifraClubProxyImplTest extends TestCase
{
    /**
     * @var CifraClubProxyImpl
     */
    private $proxy;

    protected function setUp()
    {
        $this->proxy = new CifraClubProxyImpl();
    }

    public function testGetArtistPageSuccess()
    {
        $dom = $this->proxy->paginaArtista(new Slug("lulu-santos"));
        $el = $dom->getElementById("span_bread");
        self::assertEquals("Lulu Santos", $el->innerHtml);
    }

    public function testGetArtistPageError()
    {
        self::expectException(ArtistaNaoEncontradoException::class);
        $this->proxy->paginaArtista(new Slug("lulu-santoss"));
    }

    public function testGetMusicPageSuccess()
    {
        $artist = new Artista(new Slug('lulu-santos'), 'Lulu Santos');
        $music = new Musica($artist, new Slug('de-repente-california'), 'De Repente, Califórnia');

        $dom = $this->proxy->paginaMusica($music);
        /** @var \voku\helper\SimpleHtmlDomNode $el */
        $el = $dom->find(".cifra h1");
        self::assertEquals("De Repente, Califórnia", $el->plaintext[0]);
    }

    public function testGetMusicPageError()
    {
        $artist = new Artista(new Slug('lulu-santos'), 'Lulu Santos');
        $music = new Musica($artist, new Slug('de-repente-california-com-erro'), 'De Repente, Califórnia');

        self::expectException(MusicaNaoEncontradaException::class);
        $this->proxy->paginaMusica($music);
    }
}
