<?php

class Post {
    
    private $params;
 
    function __construct($post = []) {
        $this->params = $post;
    }

    function get($name) {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }

        return null;
    }

    // function exists($name) {
    //     if (isset($this->params[$name])) {
    //         return $this->params[$name];
    //     }

    //     return null;
    // }
}