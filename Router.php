<?php

class Router {
    private $routes;
    private $path;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
        $this->path   = explode("?", $_SERVER["REQUEST_URI"])[0];
    }

    private function exists(string $path)
    {
        return !is_null($this->routes[$path]);
    }

    public function serve()
    {
        if ($this->exists($this->path)) {
            if (is_callable($this->routes[$this->path])) {
                try {
                    $this->routes[$this->path]();
                } catch (\Exception $e) {
                    $this->error($e->getCode(), $e->getMessage());
                }
            } else {
                include($this->routes[$this->path]);
            }
        } else {
            exit("Route not found");
        }
    }

    public function error($code, $text)
    {
        exit("Error #$code in route " . $this->path . ": $text");
    }
}
