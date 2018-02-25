<?php

namespace Konscia\CifraClub;

/**
 * Localiza os Acordes de Músicas.
 *
 * Class LocalizadorDeAcordes
 * @package Konscia\CifraClub\Domain\Services
 */
class LocalizadorDeAcordes
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    /**
     * @var AcordesFactory
     */
    private $acordesFactory;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(
        CifraClubProxyInterface $cifraClubProxy,
        AcordesFactory $acordesFactory,
        Cache $cache
    ) {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->acordesFactory = $acordesFactory;
        $this->cache = $cache;
    }

    public function pegaAcordesDeUmaMusica(Musica $musica) : Acordes
    {
        $chave = "artista.{$musica->getArtista()->getSlug()}.music.{$musica->getSlug()}.acordes";
        if($this->cache->temItemEmCachePara($chave)) {
            return $this->cache->pegaItem($chave);
        }

        $page = $this->cifraClubProxy->paginaMusica($musica);
        $acordes = $this->acordesFactory->criaInstanciaAPartirDoHtmlEDaMusica($page, $musica);

        $this->cache->salva($chave, $acordes);
        return $acordes;
    }
}