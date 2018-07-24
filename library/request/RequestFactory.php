<?php 

class RequestFactory {
    public function createFromGlobals($globals = [], $server = []) {
        return new $controller($router->getModel(), $router->getController(), $router->getAction(), $router);
    }
}