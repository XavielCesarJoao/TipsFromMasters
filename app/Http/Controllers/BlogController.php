<?php

namespace App\Http\Controllers;

use app\Http\Interface\ManipulacaoBancoDados;

class BlogController extends Controller implements ManipulacaoBancoDados
{
    public function inserir()
    {
    }

    public function buscar()
    {
        return 'Blog';
    }
}
