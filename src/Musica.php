<?php

namespace Konscia\CifraClub;

class Musica
{
    /**
     * @var Artista
     */
    private $artista;

    /**
     * @var Slug
     */
    private $slug;

    /**
     * @var string
     */
    private $nome;

    public function __construct(Artista $artist, Slug $slug, string $nome)
    {
        $this->artista = $artist;
        $this->nome = $nome;
        $this->slug = $slug;
    }

    public function getArtista(): Artista
    {
        return $this->artista;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }
}