<?php
class Debugger {
     
    public static $errors = [];

    public static function getAll(){
        echo '<div class="php-debugging"><pre>';
        foreach (self::$errors as $name => $error) {
            echo '<br/><br/>';
            echo '<h1>' . $name . '</h1>';
            print_r($error);
            echo '<br/><br/>';
        }
        echo '</pre></div>';
    }

    public static function add($name, $value){
        self::$errors[$name] = $value;
    }
}
