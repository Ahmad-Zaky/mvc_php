<?php

class Route {
    
    protected static $root = "/";
    
    protected static $uri = "/";

    protected static $pattern = "#^%s%s$#siD";

    public function __construct($root = "/", $uri = "/", $pattern = "#^%s%s$#siD")
    {
        self::$root = $root;

        self::$uri = $uri;

        self::$pattern = $pattern;
    }

    public static function get($path = "/", $controller = NULL, $action = NULL)
    {
        return static::handle($path, $controller, "GET", $action);
    }

    public static function post($path = "/", $controller = NULL, $action = NULL)
    {
        return static::handle($path, $controller, "POST", $action);
    }

    public static function put($path = "/", $controller = NULL, $action = NULL)
    {
        return static::handle($path, $controller, "PUT", $action);
    }

    public static function delete($path = "/", $controller = NULL, $action = NULL)
    {
        return static::handle($path, $controller, "DELETE", $action);
    }

    protected static function handle($path = "/", $controller = "", $method = "", $action = NULL)
    {
        $path = static::processPath($path);
        
        static::$uri = static::processUri($_SERVER['REQUEST_URI']);

        if ($_SERVER["REQUEST_METHOD"] !== $method) {
            // TODO: Throw exception
            return false;
        }

        $pattern = sprintf(static::$pattern, static::$root, $path);
        if (preg_match($pattern, static::$uri)) {
            static::execute($controller ?? $path, $action);
        }
        
        return false;
    }

    protected static function execute($controller, $action = NULL) 
    {
        if (is_callable($controller)) { $controller(); exit();}

        require_once "..". DIRECTORY_SEPARATOR ."controller". DIRECTORY_SEPARATOR ."{$controller}.php";

        $controller = new $controller;
        $action ? $controller->$action() : $controller();

        exit();
    }

    protected static function processPath($path) 
    {
        if (! $path) return "";

        return ltrim(str_replace("//", "/", $path), "/");
    }

    protected static function processUri($uri) 
    {
        if (! $uri) return "";

        return self::$root . trim(str_replace("//", "/", $uri), "/");
    }
}