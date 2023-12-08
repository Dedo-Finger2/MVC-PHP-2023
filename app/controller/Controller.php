<?php

namespace App\controller;

use App\utils\View;

class Controller
{
    use View;


    /**
     * Método responsável por aplicar o layout padrão em todas as views
     *
     * @param string $title - Título dinâmico da página
     * @param string $content - Conteúdo dinâmico da página
     * @return string
     */
    public static function view(array $data)
    {
        return self::render("layouts.layout", [
            "title" => $data['title'] ? $data['title'] : '',
            "content" => $data['content'] ? $data['content'] : '',
            "header" => self::renderComponent("header"),
            "footer" => self::renderComponent("footer"),
        ]);
    }



}
