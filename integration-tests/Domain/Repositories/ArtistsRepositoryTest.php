<?php

namespace Konscia\CifraClub\Domain\Repositories;

use Konscia\CifraClub\Domain\Entities\Artist;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use Konscia\CifraClub\Infrastructure\CifraClubProxyImpl;
use PHPUnit\Framework\TestCase;

class ArtistsRepositoryTest extends TestCase
{
    /**
     * @var ArtistsRepository
     */
    private $repository;

    protected function setUp()
    {
        $this->repository = new ArtistsRepository(
            new CifraClubProxyImpl()
        );
    }

    public function testfindBySlugSuccess()
    {
        $artist = $this->repository->findBySlug(new Slug('lulu-santos'));
        self::assertInstanceOf(Artist::class, $artist);
        self::assertEquals($artist->getName(), "Lulu Santos");
    }
}
