<?php

namespace Konscia\CifraClub;

use Stash\Driver\FileSystem;
use Stash\Interfaces\PoolInterface;
use Stash\Pool;

/**
 * Esta classe abstrai o uso de cache pela aplicação.
 *
 * Ela foi construída para evitar que você precise nesse curso entender
 * a lógica utilizada pela biblioteca tedivm/stash e esconder detalhes simples
 * e decisões puramente para este projeto como o tempo do cache
 *
 * Class Cache
 * @package Konscia\CifraClub
 */
class Cache
{
    /**
     * @var PoolInterface
     */
    private $pool;

    public function __construct()
    {
        /*
         * Essa inicialização ficaria muito melhor
         * sendo feita com um contêiner e injeção de dependência.
         *
         * Apenas para fins didáticos, resolvi esconder qualquer complexidade no sistema de cache
         */
        $driver = new FileSystem(['path' => __DIR__ . '/../tmp']);
        $this->pool = new Pool($driver);
    }

    /**
     * Verifica se existe algum ítem válido em cache
     *
     * @param string $chave
     * @return bool
     */
    public function temItemEmCachePara(string $chave) : bool {
        $item = $this->pool->getItem($chave);
        return $item->isHit();
    }

    /**
     * Retorna o objeto salvo no cache.
     *
     * @param $chave
     * @return mixed
     */
    public function pegaItem($chave) {
        $item = $this->pool->getItem($chave);
        return $item->get();
    }

    /**
     * Salva um valor no cache por um mês para uma determinada chave
     *
     * @param $chave
     * @param $itemParaSalvar
     */
    public function salva($chave, $itemParaSalvar) {
        $item = $this->pool->getItem($chave);

        $item->set($itemParaSalvar);
        $item->expiresAfter(new \DateInterval('P1M'));
        $this->pool->save($item);
    }
}