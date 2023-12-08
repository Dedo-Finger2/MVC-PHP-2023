<?php

namespace App\http;

use Closure;
use Exception;
use App\utils\Log;
use ReflectionFunction;

class Router
{
    private string $url = ''; # URL completa do projeto
    private string $prefix = ''; # Prefixo comum em todas as rotas
    private array $routes = []; # Todas as rotas do projeto
    private Request $request; # Instância de request

    public function __construct(string $url)
    {
        $this->request = new Request;
        $this->url = $url;
        $this->setPrefix();
    }


    private function setPrefix()
    {
        # Informações da URL
        $parseUrl = parse_url($this->url);

        # Definir prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }


    private function addRoute(string $method, string $route, array $params = [])
    {
        # Validar parâmetros
        foreach ($params as $key => $value) {
            # Se algum dos parâmetros for uma closure
            if ($value instanceof Closure) {
                # Vamos mudar o índice doarray que antes era númerico [0] para [controller]
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        # Variáveis da rota
        $params['variables'] = [];

        # Padrão de validação das variáveis das rotas
        $patternVariable = '/{(.*?)}/';
        if (preg_match_all($patternVariable, $route, $matches)) {
            $route = preg_replace($patternVariable, '(.*?)', $route);
            $params['variables'] = $matches[1];
        }

        # Expressão regular para validar o padrão das rotas
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        # Adicionar a rota no Router
        $this->routes[$patternRoute][$method] = $params;
    }


    public function get(string $route, array $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }


    public function put(string $route, array $params = [])
    {
        return $this->addRoute('PUT', $route, $params);
    }


    public function post(string $route, array $params = [])
    {
        return $this->addRoute('POST', $route, $params);
    }


    public function delete(string $route, array $params = [])
    {
        return $this->addRoute('DELETE', $route, $params);
    }


    private function getUri(): string
    {
        # Retornar URI sem prefixo
        $uri = $this->request->getUri();
        
        # Remove o prefixo da URI se houver, se não só retorna ela
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];
        
        # Retorna a URI sem prefixo que vai estar sempre no ultimo indice do array
        return end($xUri);
    }   


    private function getRoute(): array
    {
        $uri = $this->getUri();

        $httpMethod = $this->request->getMethod();

        foreach ($this->routes as $patternRoute => $methods) {
            # Verificar se a URI está nos padrões
            if (preg_match($patternRoute, $uri, $matches)) {
                # Validar o método
                if (isset($methods[$httpMethod])) {
                    # Remove a primeira posição contendo tudo
                    unset($matches[0]);

                    # Chaves das variáveis
                    $keys = $methods[$httpMethod]['variables'];
                    # Variáveis processadas
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    # Retorno dos parâmetros da rota
                    return $methods[$httpMethod];
                }
                # Método não permitido
                throw new Exception('Method not allowed.', 405);
            }
        }
        # Url não encontrada
        throw new Exception('URL not found.',404);
    }


    public function run(): Response
    {
        try {
            # Obter a rota atual
            $route = $this->getRoute();

            # Validar existencia do controlador
            if (!isset($route['controller'])) throw new Exception('URL could not be processed. Controller not found.',500);

            # Argumentos do método do controlador
            $args = [];

            # Reflection
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter) {
                $name = $parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            # Retornar a response executando o controlador
            return call_user_func_array($route['controller'], $args);

        } catch (Exception $e) {
            Log::log($e->getMessage(), $e->getFile(), $e->getLine(), $e->getcode());
            return new Response($e->getCode(), $e->getMessage());
        }
    }

}
