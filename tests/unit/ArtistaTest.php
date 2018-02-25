<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Slug;
use PHPUnit\Framework\TestCase;

class ArtistaTest extends TestCase
{
    public function testConstructor()
    {
        $artista = new Artista(new Slug("artista"), "Artista");
        self::assertSame('artista', (string)$artista->getSlug());
        self::assertSame('Artista', $artista->getName());
    }

    public function testMusicas()
    {
        $artista = new Artista(new Slug("artista"), "Artista");

        $musicas = [
            new Musica($artista, new Slug('m'), "M"),
            new Musica($artista, new Slug('m2'), "M2"),
        ];

        self::assertCount(0, $artista->getMusicas());
        $artista->setMusicas($musicas);
        self::assertSame($musicas, $artista->getMusicas());


    }
}
