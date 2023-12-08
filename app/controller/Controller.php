<?php

namespace App\controller;

use Exception;
use App\utils\Log;
use App\utils\View;

class Controller
{
    use View;


    /**
     * Método responsável por aplicar o layout padrão em todas as views
     *
     * @param string $title - Título dinâmico da página
     * @param string $content - Conteúdo dinâmico da página
     * @return string|null - Layout com o conteúdo da página que vai usar o layout
     */
    public static function view(array $data)
    {
        try {
            # Retornando o layout com as variáveis padrão
            return self::render("layouts.layout", [
                "title" => $data['title'] ?? '',
                "content" => $data['content'] ?? '',
                "header" => self::renderComponent("header") ?? '',
                "footer" => self::renderComponent("footer") ?? '',
            ]);
        } catch (Exception $e) {
            Log::log($e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
            die();
        }
    }
}
