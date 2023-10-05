<?php

class Router {
    private $routes = [];
    public $urlpatterns = [];
    public $result = 404;

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
                $this->result = 200;
                return $patternObject->executable->execute($data);
            }
        }
        $this->result = 404;
        return "404 Not Found";
        echo "404 Not Found";
    }
}


