<?php

namespace Konscia\CifraClub;

use PHPUnit\Framework\TestCase;
use voku\helper\HtmlDomParser;

class ArtistaFactoryTest extends TestCase
{
    /**
     * @var ArtistaFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ArtistaFactory();
    }

    public function testCreateFromHtml()
    {
        $slug = new Slug("lulu-santos");
        $html = new HtmlDomParser("
            <span id='span_bread'>Lulu Santos</span>
            <ol class='list-links art_musics all'>
                <li><a href='/artista/musica' class='art_music-link'>Música</a></li>
                <li><a href='/artista/musica2' class='art_music-link'>Música 2</a></li>
                
                <li><a href='/artista/musica2/letra' class='art_music-link'>Deve Ignorar</a></li>
                <li><a href='#link-local' class='art_music-link'>Deve Ignorar</a></li>
            </ol>
        ");

        $artist = $this->factory->criaInstanciaAPartirDoSlugEdoHtml($html, $slug);

        self::assertInstanceOf(Artista::class, $artist);
        self::assertEquals($slug, $artist->getSlug());
        self::assertEquals('Lulu Santos', $artist->getName());

        $musics = $artist->getMusicas();
        self::assertCount(2, $musics);
        self::assertEquals("musica2", $musics[1]->getSlug());
        self::assertEquals("Música 2", $musics[1]->getNome());
        self::assertSame($artist, $musics[1]->getArtista());
    }
}
