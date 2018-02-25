<?php

namespace Konscia\CifraClub;

class Slug
{
    private $value;

    public function __construct($value)
    {
        if (!$this->validate($value)) {
            throw new \InvalidArgumentException("O slug informado não é válido.");
        }

        $this->value = $value;
    }

    private function validate($value) : bool
    {
        //se encontrar dois tracinhos seguidos, é um slug inválido
        if (mb_strstr($value, '--')) {
            return false;
        }

        //só permite números, letras minúsculas e tracinho, nada mais.
        if (!preg_match('@^[0-9a-z\-]+$@', $value)) {
            return false;
        }

        //não permite um slug que comece ou termine com tracinho
        if (preg_match('@^-|-$@', $value)) {
            return false;
        }

        return true;
    }

    function __toString() : string
    {
        return $this->value;
    }
}