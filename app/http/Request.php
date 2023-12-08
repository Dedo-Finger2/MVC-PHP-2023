<?php

namespace App\http;

class Request
{
    private string $method; # Método HTTP da requsição [GET/POST]
    private string $uri; # Rota
    private array $queryParams = []; # Parâmetros da URL vindos via GET
    private array $postVars = []; # Variáveis que vem de requisições via POST
    private array $headers = []; # Cabeçalho da requisição


    public function __construct()
    {
        $this->queryParams = $_GET                            ?? [];
        $this->postVars    = $_POST                           ?? [];
        $this->headers     = getallheaders()                  ?? [];
        $this->method      = $_SERVER      ['REQUEST_METHOD'] ?? '';
        $this->uri         = $_SERVER      ['REQUEST_URI']    ?? '';
    }


    /**
     * Get the value of method
     */ 
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Get the value of uri
     */ 
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Get the value of headers
     */ 
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Get the value of queryParams
     */ 
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * Get the value of postVars
     */ 
    public function getPostVars()
    {
        return $this->postVars;
    }
}
