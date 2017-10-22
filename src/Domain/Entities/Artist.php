<?php

namespace Konscia\CifraClub\Domain\Entities;

use Konscia\CifraClub\Domain\ValueObjects\Slug;

class Artist
{
    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Music[]
     */
    private $musics = [];

    public function __construct(Slug $slug, string $name)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @param Music[] $musics
     */
    public function setMusics(array $musics)
    {
        $this->musics = $musics;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    /**
     * @return Music[]
     */
    public function getMusics(): array
    {
        return $this->musics;
    }
}