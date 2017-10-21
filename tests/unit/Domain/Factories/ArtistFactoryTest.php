<?php

namespace Konscia\CifraClub\Domain\Factories;

use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;
use voku\helper\HtmlDomParser;

class ArtistFactoryTest extends TestCase
{
    /**
     * @var ArtistFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new ArtistFactory();
    }

    public function testCreateFromHtml()
    {
        $slug = new Slug("lulu-santos");
        $html = new HtmlDomParser("<span id='span_bread'>Lulu Santos</span>");

        $artist = $this->factory->createFromSlugAndHtmlCifraClub($slug, $html);
        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($slug, $artist->getSlug());
        self::assertEquals('Lulu Santos', $artist->getName());
    }
}
