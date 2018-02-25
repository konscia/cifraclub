<?php

namespace Konscia\CifraClub\Services;

use Konscia\CifraClub\Cache;
use Konscia\CifraClub\ArtistaFactory;
use Konscia\CifraClub\Artista;
use Konscia\CifraClub\Slug;
use Konscia\CifraClub\CifraClubProxyImpl;
use Konscia\CifraClub\LocalizadorDeArtistas;
use PHPUnit\Framework\TestCase;

class LocalizadorDeArtistaTest extends TestCase
{
    /**
     * @var LocalizadorDeArtistas
     */
    private $service;

    protected function setUp()
    {
        /** @var Cache $mockCache */
        $mockCache = self::getMockBuilder(Cache::class)->disableOriginalConstructor()->getMock();

        $this->service = new LocalizadorDeArtistas(
            new CifraClubProxyImpl(),
            new ArtistaFactory(),
            $mockCache
        );
    }

    public function testEncontraPeloSlugTrazArtistaComNome()
    {
        $artist = $this->service->encontraPeloSlug(new Slug('lulu-santos'));

        self::assertInstanceOf(Artista::class, $artist);
        self::assertEquals($artist->getName(), "Lulu Santos");
    }

    public function testEncontraPeloSlugTrazAsMusicasDoArtista()
    {
        $artist = $this->service->encontraPeloSlug(new Slug('uniclas'));
        $musics = $artist->getMusicas();

        self::assertCount(16, $musics);
        self::assertContains("Som do Sonho", array_map(function($music) { return (string)$music->getName(); }, $musics));
        self::assertContains("som-do-sonho", array_map(function($music) { return (string)$music->getSlug(); }, $musics));
    }
}
