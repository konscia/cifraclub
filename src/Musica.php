<?php

namespace Konscia\CifraClub;

class Musica
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $url;

    /**
     * @var Acordes
     */
    private $acordes;

    public function __construct(string $nome, string $url, Acordes $acordes)
    {
        $this->nome = $nome;
        $this->url = $url;
        $this->acordes = $acordes;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAcordes(): Acordes
    {
        return $this->acordes;
    }
}