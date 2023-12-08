<?php

namespace App\controller;

use App\utils\View;

class HomeController
{
    use View;

    /**
     * Método responsável por retornar a view home que será impresso na tela
     *
     * @return string - Conteúdo HTML
     */
    public static function index()
    {
        return self::render("home");
    }
}
