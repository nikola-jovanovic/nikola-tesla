<?php

class Route {

    private $pattern;
    private $tokens;
    private $contoller;
    private $action;
    private $alias;
    private $type;

    private function __construct(string $type, string $pattern, string $controller, string $action, string $alias, array $tokens = []) {

        $this->type         =  $type;
        $this->pattern      =  $pattern;
        $this->controller   =  $controller;
        $this->action       =  $action;
        $this->alias        =  $alias;
        $this->tokens       =  $tokens;
    }

    public function getPattern() {
        return $this->pattern;
    }

    public function getTokens() {
        return $this->tokens;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getAlias() {
        return $this->alias;
    }

    public function getType() {
        return $this->type;
    }

    static function create(string $type, string $pattern, string $controller, string $action, string $alias, array $tokens = []) {
        return new static(...func_get_args());
    }
}
