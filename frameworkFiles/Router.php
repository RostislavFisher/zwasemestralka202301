<?php

class Router {
    private $routes = [];
    public $urlpatterns = [];

    public function addRoute($pattern, $handler) {
        $this->routes[$pattern] = $handler;
    }

    public function route($data) {
        foreach ($this->urlpatterns as $patternObject) {
            $pattern = preg_replace_callback('/\{([^}]+)\}/', function($matches) {
                return '([^/]+)';
            }, $patternObject->path);

            if (preg_match("#^$pattern$#", $data->url, $matches)) {
                foreach ($matches as $key => $value) {
                    if (!is_numeric($key)) {
                        echo $key . " " . $value . "<br>";
                    }
                }
                $data->setMatches($matches);
                return $patternObject->executable->execute($data);
            }
        }
        return "404 Not Found";
        echo "404 Not Found";
    }
}


