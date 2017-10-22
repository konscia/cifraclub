<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Infrastructure\CifraClubProxyImpl;
use PHPUnit\Framework\TestCase;
use Stash\Driver\Ephemeral;
use Stash\Pool;

class ArtistLocatorTest extends TestCase
{
    /**
     * @var ArtistLocator
     */
    private $service;

    protected function setUp()
    {
        $this->service = new ArtistLocator(
            new CifraClubProxyImpl(),
            new ArtistFactory(),
            new Pool(new Ephemeral([]))
        );
    }

    public function testfindBySlugSuccess()
    {
        $artist = $this->service->findBySlug(new Slug('lulu-santos'));
        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($artist->getName(), "Lulu Santos");
    }

    public function testfindRecoverMusics()
    {
        $artist = $this->service->findBySlug(new Slug('uniclas'));
        self::assertInstanceOf(Artist::class, $artist);
        $musics = $artist->getMusics();
        self::assertCount(16, $musics);
        self::assertContains("Som do Sonho", array_map(function($music) { return (string)$music->getName(); }, $musics));
        self::assertContains("som-do-sonho", array_map(function($music) { return (string)$music->getSlug(); }, $musics));
    }
}
