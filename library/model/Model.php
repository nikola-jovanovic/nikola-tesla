<?php
class Model extends Sql {
    protected $model;
    protected $table;
    protected $exists = false;
    protected $attributes = [];
 
    function __construct() {
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ];
        $this->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, $options);
        $this->model = get_class($this);
        $this->table = strtolower($this->model)."s";
    }
    
    function save() {
        $this->saveBla($this->attributes);
    }

    function __set($prop, $val) {
        $this->attributes[$prop] = $val;
    }

    function __destruct() {
        $this->disconnect();
    }
}