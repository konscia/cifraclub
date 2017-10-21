<?php

namespace Konscia\CifraClub\Domain\Entities;

use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;

class ArtistTest extends TestCase
{
    public function testConstructor()
    {
        $artist = new Artist(new Slug("artista"), "Artista");
        self::assertSame('artista', (string)$artist->getSlug());
        self::assertSame('Artista', $artist->getName());
    }
}
