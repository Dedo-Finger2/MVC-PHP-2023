<?php

namespace App\http;

class Response
{
    private int $httpCode = 200; # Código da resposta (200 = deu tudo certo)
    private array $headers = []; # Cabeçalho da resposta
    private string $contentType = "text/html"; # Tipo de conteúdo que será retornado
    private mixed $content; # Conteúdo que será retornado na resposta

    /**
     * Método responsa´vel por criar uma responsta
     *
     * @param integer $httpCode - Código da resposta
     * @param mixed $content - Conteúdo da resposta
     * @param string $contentType - O tipo do conteúdo
     */
    public function __construct(int $httpCode, mixed $content, string $contentType = "text/html")
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }


    /**
     * Método responsável por setar o conteúdo da response (útil apenas no futuro)
     *
     * @param string $contentType - Tipo do conteúdo
     * @return void
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }


    /**
     * Método responsável por adicionar algo nos headers da response
     *
     * @param mixed $key - Chave da response
     * @param mixed $value - Valor que será posto na chave da response 
     * @return void
     */
    public function addHeader(mixed $key, mixed $value): void
    {
        $this->headers[$key] = $value;
    }


    /**
     * Método responsável por enviar a response para o navegador
     *
     * @return void
     */
    public function sendResponse(): void
    {
        # Enviar os headers previamente
        $this->sendHeaders();
        # Imprimir o conteúdo da response
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }


    /**
     * Método responsável por enviar todos os headers para o navegador
     *
     * @return void
     */
    private function sendHeaders(): void
    {
        # Enviar o código de status para o navegador
        http_response_code($this->httpCode);

        # Enviar todos os headers
        foreach ($this->headers as $key => $value) {
            header($key .': '. $value);
        }
    }

}
