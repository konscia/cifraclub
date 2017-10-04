<?php

namespace Konscia\CifraClub\Infrastructure;

use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
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
        $dom = $this->proxy->getArtistPage(new Slug("lulu-santos"));
        $el = $dom->getElementById("span_bread");
        self::assertEquals("Lulu Santos", $el->innerHtml);
    }

    public function testGetArtistPageError()
    {
        self::expectException(ArtistNotFound::class);
        $this->proxy->getArtistPage(new Slug("lulu-santoss"));
    }
}
