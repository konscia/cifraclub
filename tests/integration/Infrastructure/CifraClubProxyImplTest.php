<?php

namespace Konscia\CifraClub\Infrastructure;

use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\Entities\Music;
use Konscia\CifraClub\Domain\Exceptions\MusicNotFound;
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

    public function testGetMusicPageSuccess()
    {
        $artist = new Artist(new Slug('lulu-santos'), 'Lulu Santos');
        $music = new Music($artist, new Slug('de-repente-california'), 'De Repente, Califórnia');

        $dom = $this->proxy->getMusicPage($music);
        /** @var \voku\helper\SimpleHtmlDomNode $el */
        $el = $dom->find(".cifra h1");
        self::assertEquals("De Repente, Califórnia", $el->plaintext[0]);
    }

    public function testGetMusicPageError()
    {
        $artist = new Artist(new Slug('lulu-santos'), 'Lulu Santos');
        $music = new Music($artist, new Slug('de-repente-california-com-erro'), 'De Repente, Califórnia');

        self::expectException(MusicNotFound::class);
        $this->proxy->getMusicPage($music);
    }
}
