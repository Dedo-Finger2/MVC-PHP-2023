<?php

namespace App\utils;

trait View
{
    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     *
     * @param string $view - Nome da view que terá o conteúdo impresso
     * @return string
     */
    public static function render(string $view)
    {
        # Pegando o conteúdo da view com o método privado
        $contentView = self::getContentView($view);

        # Retornando o conteúdo da view já renderizado
        return $contentView;
    }


    /**
     * Método responsável por retornar o conteúdo de uma view
     *
     * @param string $view - Nome da view
     * @return string
     */
    private static function getContentView(string $view)
    {
        # Encontra o arquivo da view no caminho padrão das views do projeto
        $file = __DIR__ . "/../../resources/views/" . $view . ".html";

        # Retorna, se o arquivo existir, o conteúdo dele, senão, retorna uma string vazia
        return file_exists($file) ? file_get_contents($file) : "";
    }
}
