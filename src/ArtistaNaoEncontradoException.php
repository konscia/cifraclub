<?php

namespace Konscia\CifraClub;

class ArtistaNaoEncontradoException extends \DomainException
{
    public function __construct(Slug $artist)
    {
        parent::__construct("Artista \"{$artist}\" não encontrado para pesquisar acordes");
    }
}