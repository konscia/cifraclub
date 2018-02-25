<?php

namespace Konscia\CifraClub\Entities;

use Konscia\CifraClub\Acordes;
use Konscia\CifraClub\Artista;
use Konscia\CifraClub\Musica;
use Konscia\CifraClub\Slug;
use PHPUnit\Framework\TestCase;

class MusicaTest extends TestCase
{
    public function testConstructor()
    {
        $acordesArray = ['D', 'C', 'Dm'];
        $artista = new Artista(new Slug("artista"), "Artista");
        $musica = new Musica($artista, new Slug("musica"), "Música");

        $acordes = new Acordes($acordesArray, $musica);

        self::assertSame($musica, $acordes->getMusica());
        self::assertSame($acordesArray, $acordes->getAcordes());
    }
}
