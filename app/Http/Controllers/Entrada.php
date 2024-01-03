<?php

namespace App\Http\Controllers;

use app\Http\Interface\ManipulacaoBancoDados;

class Entrada extends Controller
{
    private $postAnBlog;

    public function __construct(ManipulacaoBancoDados $manipulacao)
    {
        $this->postAnBlog = new $manipulacao();
    }

    public function pegaDados()
    {
        return $this->postAnBlog->buscar();
    }
}
