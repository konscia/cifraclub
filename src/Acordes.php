<?php

namespace Konscia\CifraClub;

class Acordes
{
    /**
     * @var string[]
     */
    private $acordes;

    /**
     * @var Musica
     */
    private $musica;

    public function __construct(array $acordes, Musica $musica)
    {
        $this->acordes = $acordes;
        $this->musica = $musica;
    }

    public function getAcordes(): array
    {
        return $this->acordes;
    }

    public function totalAcordes() : int
    {
        return count($this->acordes);
    }

    public function getMusica(): Musica
    {
        return $this->musica;
    }

    public function __toString()
    {
        return implode(", ", $this->acordes);
    }
}