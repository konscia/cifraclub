<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\ValueObjects\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;
use Stash\Driver\Ephemeral;
use Stash\Pool;
use voku\helper\HtmlDomParser;

class ArtistLocatorTest extends TestCase
{
    /**
     * @var ArtistLocator
     */
    private $service;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|CifraClubProxyInterface
     */
    private $mockProxy;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ArtistFactory
     */
    private $mockFactory;

    public function setUp()
    {
        $this->mockProxy = $this->getMockBuilder(CifraClubProxyInterface::class)->getMock();
        $this->mockFactory = $this->getMockBuilder(ArtistFactory::class)->getMock();

        $pool = new Pool(new Ephemeral([]));

        $this->service = new ArtistLocator($this->mockProxy, $this->mockFactory, $pool);
    }

    public function testReturnArtistFromCifraClub()
    {
        $slug = new Slug("lulu-santos");
        $html = new HtmlDomParser();
        $artist = new Artist($slug, 'Lulu Santos');

        $this->mockProxy->expects($this->once())->method('getArtistPage')->with($slug)->willReturn($html);
        $this->mockFactory->expects($this->once())->method('createFromSlugAndHtmlCifraClub')->with($slug, $html)->willReturn($artist);

        $newArtist = $this->service->findBySlug($slug);
        self::assertSame($artist, $newArtist);
    }

    public function testIfCacheIsOk()
    {
        $slug = new Slug("lulu-santos");
        $artist = new Artist($slug, 'Lulu Santos');

        $this->mockFactory->expects($this->once())->method('createFromSlugAndHtmlCifraClub')->willReturn($artist);

        $this->service->findBySlug($slug);
        $this->service->findBySlug($slug);
    }

}
