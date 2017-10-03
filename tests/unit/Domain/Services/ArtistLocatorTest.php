<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\CifraClubProxyInterface;
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

    public function setUp()
    {
        $this->mockProxy = $this->getMockBuilder(CifraClubProxyInterface::class)->getMock();
        $pool = new Pool(new Ephemeral([]));

        $this->service = new ArtistLocator($this->mockProxy, $pool);
    }

    public function testReturnArtistFromCifraClubWithCache()
    {
        $slug = new Slug("lulu-santos");

        $html = new HtmlDomParser("<span id='span_bread'>Lulu Santos</span>");
        $this->mockProxy->expects($this->once())->method('getArtistPage')->with($slug)->willReturn($html);

        $artist = $this->service->findBySlug($slug);
        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($slug, $artist->getSlug());
        self::assertEquals('Lulu Santos', $artist->getName());
        self::assertEquals($html, $artist->getHtmlPage());

        $this->service->findBySlug($slug);  //o getArtistPage só pode ser chamado uma vez
    }


}
