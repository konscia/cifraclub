<?php

namespace Konscia\CifraClub\Application;

use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\Repositories\ArtistsRepository;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;

class EasyMusicFinderTest extends TestCase
{
    /**
     * @var EasyMusicFinder
     */
    private $service;

    /**
     * @var ArtistsRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    private $artistsRepository;

    protected function setUp()
    {
        $this->artistsRepository = $this->getMockBuilder(ArtistsRepository::class)->disableOriginalConstructor()->getMock();
        $this->service = new EasyMusicFinder($this->artistsRepository);
    }

    public function testThrowExceptionIfArtistNotFound()
    {
        $slug = new Slug("nome-artista");
        $this->artistsRepository->expects($this->once())->method('findBySlug')->with($slug)->willReturn(null);

        self::expectException(ArtistNotFound::class);
        $this->service->findByArtistSloganAndNumberOfChords($slug, 1);
    }




}
