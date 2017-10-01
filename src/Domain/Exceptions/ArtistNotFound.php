<?php

namespace Konscia\CifraClub\Domain\Exceptions;

use Konscia\CifraClub\Domain\ValueObjects\Slug;

class ArtistNotFound extends \DomainException
{
    public function __construct(Slug $artist)
    {
        parent::__construct("Artista \"{$artist}\" não encontrado para pesquisar acordes");
    }
}