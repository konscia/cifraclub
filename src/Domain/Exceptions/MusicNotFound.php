<?php

namespace Konscia\CifraClub\Domain\Exceptions;

use Konscia\CifraClub\Domain\Entities\Music;

class MusicNotFound extends \DomainException
{
    public function __construct(Music $music)
    {
        parent::__construct("Música \"{$music->getSlug()}\" não encontrada para pesquisar acordes");
    }
}