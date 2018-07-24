<?php 

class ControllerFactory {
    public function createFromRouter(Router $router) {
    	$controller = $router->getController();

        if ($controller && class_exists($controller)) {
            return new $controller();
        }

        return false;
    }
}