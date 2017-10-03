<?php

namespace Konscia\CifraClub\Application;

use Konscia\CifraClub\Domain\Exceptions\ArtistNotFound;
use Konscia\CifraClub\Domain\Repositories\ArtistsRepository;
use Konscia\CifraClub\Domain\Services\ArtistLocator;
use Konscia\CifraClub\Domain\ValueObjects\Slug;
use PHPUnit\Framework\TestCase;

class EasyMusicFinderTest extends TestCase
{
    /**
     * @var EasyMusicFinder
     */
    private $service;

    /**
     * @var ArtistLocator|\PHPUnit_Framework_MockObject_MockObject
     */
    private $artistLocator;

    protected function setUp()
    {
        $this->artistLocator = $this->getMockBuilder(ArtistLocator::class)->disableOriginalConstructor()->getMock();
        $this->service = new EasyMusicFinder($this->artistLocator);
    }
}
