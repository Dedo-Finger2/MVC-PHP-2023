<?php

namespace App\utils;

use Exception;
use App\utils\Log;

trait View
{
    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     *
     * @param string $view - Nome da view que terá o conteúdo impresso
     * @param array $vars - Variáveis que serão passadas para a view
     * @return string
     */
    public static function render(string $view, array $vars = [])
    {
        $view = str_replace(".", "/", $view);

        # Pegando o conteúdo da view com o método privado
        try {
            $contentView = self::getContentView($view);
        } catch (Exception $e) {
            Log::log($e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
            die();
        }

        # Descobrir o nome das variáveis (chaves do array de vars)
        $keys = array_keys($vars);
        # Aplicar padrão de variáveis da view (todas estão em volta de duas chaves espaçadas)
        $keys = array_map(function ($item) {
            return "{{ $item }}";
        }, $keys);

        # Retornando o conteúdo da view já renderizado com as possíveis variáveis que foram passadas para a view
        return str_replace($keys, array_values($vars), $contentView);
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
        return file_exists($file) ? file_get_contents($file) : throw new Exception("File $file not found.");
    }


    /**
     * Método responsável por renderizar o header da view
     *
     * @return string - Conteúdo do arquivo renderizado
     */
    private static function renderComponent(string $name)
    {
        try {
            return self::render("components.$name");
        } catch (Exception $e) {
            echo $e->getMessage();
            return "";
        }
    }
}
