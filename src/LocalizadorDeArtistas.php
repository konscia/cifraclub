<?php

namespace Konscia\CifraClub;

class LocalizadorDeArtistas
{
    /**
     * @var CifraClubProxyInterface
     */
    private $cifraClubProxy;

    /**
     * @var ArtistaFactory
     */
    private $factory;

    /**
     * @var Cache
     */
    private $cache;

    public function __construct(
        CifraClubProxyInterface $cifraClubProxy,
        ArtistaFactory $factory,
        Cache $cache
    ) {
        $this->cifraClubProxy = $cifraClubProxy;
        $this->factory = $factory;
        $this->cache = $cache;
    }

    public function encontraPeloSlug(Slug $slug) : Artista
    {
        $chave = 'artista.'.$slug;

        if($this->cache->temItemEmCachePara($chave)) {
            return $this->cache->pegaItem($chave);
        }

        $page = $this->cifraClubProxy->paginaArtista($slug);
        $artist = $this->factory->criaInstanciaAPartirDoSlugEdoHtml($page, $slug);

        $this->cache->salva($chave, $artist);
        return $artist;
    }
}