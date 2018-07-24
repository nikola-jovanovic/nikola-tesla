<?php

class Request {

    private $query;
    private $request;
    private $cookie;
    private $files;
    private $server;

    private $type;
    private $path;
    private $property;

    private function __construct(array $get = [], array $post = [], array $cookie = [], array $files = [], array $server = []) {

        $this->query    = $get;
        $this->request  = $post;
        $this->cookie   = $cookie;
        $this->files    = $files;
        $this->server   = $server;

        $this->init();
    }

    private function init() {
        if (!(isset($this->server["REQUEST_METHOD"]) && isset($this->server['REQUEST_URI']))) {
            // throw exception
        }

        $this->type = $this->server["REQUEST_METHOD"];
        $this->property = $this->type === "GET" ? "query" : "request";

        $url = parse_url($this->server['REQUEST_URI']);

        if ($url) {
            if (isset($url['path'])) {
                $this->path = $url['path'];
            }
        }
    }

    static function createFromGlobals() {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function input(string $name) {
        return $this->{$this->property}[$name] ?? null;
    }

    public function has(string $name) {
        return isset($this->{$this->$property}[$name]) ? true : false;
    }

    public function all() {
        return $this->{$this->property};
    }

    public function getPath() {
        return $this->path;
    }

    public function getType() {
        return $this->type;
    }

    public function getCookie ($name) {
        return $this->cookie[$name];
    }
}
