<?php

namespace Konscia\CifraClub\Entities;

use Konscia\CifraClub\Artista;
use Konscia\CifraClub\Musica;
use Konscia\CifraClub\Slug;
use PHPUnit\Framework\TestCase;

class MusicaTest extends TestCase
{
    public function testConstructor()
    {
        $artista = new Artista(new Slug('a'), "A");
        $musica = new Musica($artista, new Slug("musica"), "Música");

        self::assertSame('musica', (string)$musica->getSlug());
        self::assertSame('Música', $musica->getNome());
        self::assertSame($artista, $musica->getArtista());
    }
}
