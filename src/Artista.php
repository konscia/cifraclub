<?php

namespace Konscia\CifraClub;

use Konscia\CifraClub\Musica;
use Konscia\CifraClub\Slug;

class Artista
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
     * @var Musica[]
     */
    private $musicas = [];

    public function __construct(Slug $slug, string $name)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    /**
     * @param Musica_old[] $musicas
     */
    public function setMusicas(array $musicas)
    {
        $this->musicas = $musicas;
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
     * @return Musica[]
     */
    public function getMusicas(): array
    {
        return $this->musicas;
    }
}