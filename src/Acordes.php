<?php

namespace Konscia\CifraClub;

class Acordes
{
    /**
     * @var array
     */
    private $acordes;

    public function __construct(array $acordes)
    {
        $this->acordes = $acordes;
    }

    public function getAcordes(): array
    {
        return $this->acordes;
    }

    public function totalAcordes() : int
    {
        return count($this->acordes);
    }

    public function __toString()
    {
        return implode(", ", $this->acordes);
    }
}