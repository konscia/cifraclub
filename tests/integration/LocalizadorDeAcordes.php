<?php

namespace Konscia\CifraClub;

use PHPUnit\Framework\TestCase;

class LocalizadorDeArtistaTest extends TestCase
{
    /**
     * @var LocalizadorDeAcordes
     */
    private $service;

    protected function setUp()
    {
        /** @var Cache $mockCache */
        $mockCache = self::getMockBuilder(Cache::class)->disableOriginalConstructor()->getMock();

        $this->service = new LocalizadorDeAcordes(
            new CifraClubProxyImpl(),
            new AcordesFactory(),
            $mockCache
        );
    }

    public function testEncontraAcordes()
    {
        $artista = new Artista(new Slug("chico-buarque"), "Chico Buarque");
        $musica = new Musica($artista, new Slug("a-banda"), "A Banda");

        $acordes = $this->service->pegaAcordesDeUmaMusica($musica);

        self::assertCount(12, $acordes->getAcordes());
        self::assertEquals(['D6/9', 'A7', 'F#m7', 'B7', 'E7(9)', 'D7M', 'Am6/C', 'Em7', 'Em/D', 'C#m7', 'F#7(9)', 'Em7(9)'], $acordes->getAcordes());
    }
}
