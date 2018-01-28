<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Cache;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Infrastructure\CifraClubProxyImpl;
use Konscia\CifraClub\LocalizadorDeArtista;
use PHPUnit\Framework\TestCase;
use Stash\Driver\Ephemeral;
use Stash\Pool;

class LocalizadorDeArtistaTest extends TestCase
{
    /**
     * @var LocalizadorDeArtista
     */
    private $service;

    protected function setUp()
    {
        $mockCache = self::getMockBuilder(Cache::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new LocalizadorDeArtista(
            new CifraClubProxyImpl(),
            new ArtistFactory(),
            $mockCache
        );
    }

    public function testEncontraPeloSlugTrazArtistaComNome()
    {
        $artist = $this->service->encontraPeloSlug(new Slug('lulu-santos'));

        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($artist->getName(), "Lulu Santos");
    }

    public function testEncontraPeloSlugTrazAsMusicasDoArtista()
    {
        $artist = $this->service->encontraPeloSlug(new Slug('uniclas'));
        $musics = $artist->getMusics();

        self::assertCount(16, $musics);
        self::assertContains("Som do Sonho", array_map(function($music) { return (string)$music->getName(); }, $musics));
        self::assertContains("som-do-sonho", array_map(function($music) { return (string)$music->getSlug(); }, $musics));
    }
}
