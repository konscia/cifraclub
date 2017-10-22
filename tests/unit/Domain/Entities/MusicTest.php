<?php

namespace Konscia\CifraClub\Domain\Entities;

use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;

class MusicTest extends TestCase
{
    public function testConstructor()
    {
        $artist = new Artist(new Slug('a'), "A");
        $music = new Music($artist, new Slug("musica"), "Música");
        self::assertSame('musica', (string)$music->getSlug());
        self::assertSame('Música', $music->getName());
        self::assertSame($artist, $music->getArtist());
    }
}
