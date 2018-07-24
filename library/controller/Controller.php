<?php

// namespace Library\Controller;

class Controller {

    protected $template;

    function __construct() {
        $this->template = new Template();

    }

    public function callAction(string $method, array $params) {
        if (!(int)method_exists($this, $method)) {
            /* Error Generation Code Here */
        }

        call_user_func_array([$this, $method], $params);
    }

    function view(string $path, array $data = []) {
        $this->template->view($path, $data);
    }

    function __destruct() {
        $this->template->render();
    }
}
