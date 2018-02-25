<?php

namespace Konscia\CifraClub;

class MusicaNaoEncontradaException extends \DomainException
{
    public function __construct(Musica $music)
    {
        parent::__construct("Música \"{$music->getSlug()}\" não encontrada para pesquisar acordes");
    }
}