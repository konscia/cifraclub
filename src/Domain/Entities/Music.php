<?php

namespace Konscia\CifraClub\Domain\Entities;

use Konscia\CifraClub\Domain\ValueObjects\Slug;

class Music
{
    /**
     * @var Artist
     */
    private $artist;

    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var string
     */
    private $name;

    public function __construct(Artist $artist, Slug $slug, string $name)
    {
        $this->artist = $artist;
        $this->name = $name;
        $this->slug = $slug;
    }

    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }
}