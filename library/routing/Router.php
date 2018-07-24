<?php

class Router {
    
    private $request;
    private $controller;
    private $action;
    private $params;
    private $routes = [];
    private $route;
 
    private function __construct(Request $request) {

        $this->request = $request;
    }
    
    public function init() {
        $path = $this->request->getPath();
        
        if ($path) {

            $this->params = $this->parseUrl($path);

            if ($this->route) {
                $this->controller = $this->route->getController();
                $this->action = $this->route->getAction();
            }
            
        }
    }

    private function parseUrl(string $url) {

        $tokens = array();

        foreach ($this->routes as $route) {
            preg_match("@^" . $route->getPattern() . "$@", $url, $matches);

            if ($matches && $route->getType() === $this->request->getType()) {
                $this->route = $route;

                foreach ($matches as $key=>$match) {
                    // Not interested in the complete match, just the tokens
                    if ($key == 0) {
                        continue;
                    }
                    // Save the token
                    $tokens[$route->getTokens()[$key-1]] = $match;
                }

                return $tokens;
            }
        }

        return $tokens;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function addRoute(Route $route) {
        $this->routes[] = $route;
    }

    public function is(string $alias) {
        return $this->getActive()->getAlias() === $alias;
    }

    static function create(Request $request) {
        return new static($request);
    }

    public function getParamsForAction() {
        return array_merge($this->params, [$this->request]);
    }
}