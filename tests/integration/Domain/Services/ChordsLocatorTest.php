<?php

namespace Konscia\CifraClub\Domain\Services;

use Konscia\CifraClub\Domain\Entities\Music;
use Konscia\CifraClub\Domain\Factories\ArtistFactory;
use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Infrastructure\CifraClubProxyImpl;
use PHPUnit\Framework\TestCase;
use Stash\Driver\Ephemeral;
use Stash\Pool;

class ChordsLocatorTest extends TestCase
{
    /**
     * @var ChordsLocator
     */
    private $service;

    protected function setUp()
    {
        $this->service = new ChordsLocator(
            new CifraClubProxyImpl(),
            new Pool(new Ephemeral([]))
        );
    }

    public function testfindByMusicSuccess()
    {
        $artist = new Artist(new Slug('lulu-santos'), 'Lulu Santos');
        $music = new Music($artist, new Slug('de-repente-california'), 'De Repente, Califórnia');
        //nome da Música -> .cifra h1
        $this->service->findByMusic($music);
    }
}
