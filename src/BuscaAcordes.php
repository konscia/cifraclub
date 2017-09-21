<?php

namespace Konscia\CifraClub;

use Stash\Interfaces\PoolInterface;
use voku\helper\HtmlDomParser;

class BuscaAcordes
{
    /**
     * @var PoolInterface
     */
    private $cache;

    public function __construct(PoolInterface $cache)
    {
        $this->cache = $cache;
    }

    public function buscaPorMusica($urlMusica) : Acordes
    {
        $url = "https://www.cifraclub.com.br{$urlMusica}";
        $item = $this->cache->getItem($urlMusica);

        echo "Pesquisando Música: {$url}\n";

        if ($item->isHit()) {
            return $item->get();
        }

        $dom = HtmlDomParser::file_get_html($url);

        $acordesHtml = $dom->find('.cifra_cnt b');
        $acordes = [];
        foreach ($acordesHtml as $tag) {
            $acordes[] = $tag->innerHtml;
        }

        $acordesObj = new Acordes(array_values(array_unique($acordes)));

        $item->set($acordesObj);
        $this->cache->save($item);

        return $acordesObj;
    }
}