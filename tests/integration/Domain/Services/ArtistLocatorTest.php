<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\ValueObjects\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Infrastructure\CifraClubProxyImpl;
use PHPUnit\Framework\TestCase;

class ArtistLocatorTest extends TestCase
{
    /**
     * @var ArtistLocator
     */
    private $service;

    protected function setUp()
    {
        $this->service = new ArtistLocator(
            new CifraClubProxyImpl()
        );
    }

    public function testfindBySlugSuccess()
    {
        $artist = $this->service->findBySlug(new Slug('lulu-santos'));
        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($artist->getName(), "Lulu Santos");
    }
}
