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

    public function testMusics()
    {
        $artist = new Artist(new Slug("artista"), "Artista");

        $musics = [
            new Music($artist, new Slug('m'), "M"),
            new Music($artist, new Slug('m2'), "M2"),
        ];

        self::assertCount(0, $artist->getMusics());
        $artist->setMusics($musics);
        self::assertSame($musics, $artist->getMusics());


    }
}
