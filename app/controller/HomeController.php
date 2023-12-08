<?php

namespace App\controller;

use App\utils\View;

class HomeController extends Controller
{
    // use View;

    /**
     * Método responsável por retornar a view home que será impresso na tela
     *
     * @return string - Conteúdo HTML
     */
    public static function index()
    {
        $name = "Greg Almeida";

        # Guarda o conteúdo renderizado da view numa variável (home)
        $viewContent = self::render("home", [
            "name" => $name,
            "description" => "Teste MVC com PHP puro",
        ]);

        # Retorna a view com o layout aplicado (layouts.layout)
        return self::view([
            'title' => 'Titulo legal',
            'content' => $viewContent,
        ]);
    }


    public static function about()
    {
        # Guarda o conteúdo renderizado da view numa variável (home)
        $viewContent = self::render("about", [
            "name" => "Greg Almeida",
            "description" => "Teste MVC com PHP puro - Página de sobre",
        ]);

        # Retorna a view com o layout aplicado (layouts.layout)
        return self::view([
            'title' => 'About',
            'content' => $viewContent,
        ]);
    }
}
