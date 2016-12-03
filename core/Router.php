<?php

class Router
{
  protected $routes = [
    'GET' => [],
    'POST' => []
  ];

  public static function load($file)
  {
    // Use 'new static' or 'new self' which equal to 'new Router'
    $router = new static;

    require $file;

    return $router;
  }

  public function get($uri, $controller)
  {
    $this->routes['GET'][$uri] = $controller;
  }

  public function post($uri, $controller)
  {
    $this->routes['POST'][$uri] = $controller;
  }

  public function define($routes)
  {
    $this->routes = $routes;
  }

  public function direct($uri, $requestType)
  {
    if (array_key_exists($uri, $this->routes[$requestType])) {
      return $this->routes[$requestType][$uri];
    }

    throw new Exception("No route defined for this uri");

  }
}
