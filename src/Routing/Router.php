<?php
namespace App\Routing;

use Exception;

class Router
{
    private array $routes;

    public function __construct()
    {
        $this->routes = require_once APP_ROOT . "/config/routes.php";
    }

    public function handleRequest(string $uri): void
    {
        try
        {
            $uri = parse_url($uri, PHP_URL_PATH);
            $path = rtrim($uri, "/") . "/";

            if (!isset($this->routes[$path]))
            {
                throw new Exception("Route introuvable");
            }

            $route = $this->routes[$path];
            $controllerPath = $route["controller"];
            $action = $route["action"];

            if (!class_exists($controllerPath))
            {
                throw new Exception("Classe introuvable");
            }

            $controller = new $controllerPath();

            if (!method_exists($controller, $action))
            {
                throw new Exception("L'action n'existe pas");
            }

            $controller->$action();
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
}
