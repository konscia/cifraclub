<?php

use Konscia\CifraClub\BuscaAcordes;
use Konscia\CifraClub\BuscaMusicas;

if ($argc != 3) {
    echo "Uso: php musicas-faceis.php [nome-artista] [numero-maximo-acordes].\n";
    exit(1);
}
$artista = $argv[1];
$numeroMaximoAcordes = $argv[2];

include_once "vendor/autoload.php";

$driver = new \Stash\Driver\FileSystem(['path' => 'tmp']);
$pool = new Stash\Pool($driver);

$buscador = new BuscaMusicas($pool, new BuscaAcordes($pool));
$musicas = $buscador->buscaPorArtista($artista);

foreach ($musicas as $musica)
{
    if($musica->getAcordes()->totalAcordes() > $numeroMaximoAcordes) {
        break;
    }

    echo $musica->getNome()."\n";
    echo $musica->getAcordes()."\n";
    echo "\n";
}

exit(1);