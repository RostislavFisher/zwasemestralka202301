<?php

class Router {
    private $routes = [];
    public $urlpatterns = [];

    public function addRoute($pattern, $handler) {
        $this->routes[$pattern] = $handler;
    }

    public function route($url) {
        foreach ($this->urlpatterns as $patternObject) {
            // Replace {variable} with a regular expression to capture any value
            $pattern = preg_replace_callback('/\{([^}]+)\}/', function($matches) {
                return '([^/]+)';
            }, $patternObject->path);

            if (preg_match("#^$pattern$#", $url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (!is_numeric($key)) {
                        echo $key . " " . $value . "<br>";
                    }
                }
                return $patternObject->executable->execute($matches);
            }
        }
        return "404 Not Found";
        echo "404 Not Found";
    }
}


