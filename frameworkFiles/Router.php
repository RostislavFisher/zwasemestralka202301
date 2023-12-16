<?php

/**
 * Router is a global Router class. It routes the data
 */
class Router {
    /**
     * @var $routes : the routes
     */
    private $routes = [];
    /**
     * @var $urlpatterns : the urlpatterns
     */
    public $urlpatterns = [];
    /**
     * @var $result : the result
     */
    public $result = 404;

    /**
     * Adds a route
     * @param $pattern: the pattern
     * @param $handler: the handler
     */
    public function addRoute($pattern, $handler) {
        $this->routes[$pattern] = $handler;
    }

    /**
     * Routes the data
     * @param $data: the data
     */
    public function route($data) {
        $url = $data->url;
        foreach ($this->urlpatterns as $patternObject) {
            $pattern = preg_replace_callback('/\{([^}]+)\}/', function($matches) {
                return '([^/]+)';
            }, $patternObject->path);

            if (preg_match("#^$pattern$#", explode("?", $url)[0], $matches)) {
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


