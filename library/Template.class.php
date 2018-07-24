<?php
class Template {

    protected $variables = array();
    protected $layout;
    protected $_view;

    function __construct() {
        $this->layout = "master";
    }

    /** Display Template **/
    function render() {
        echo $this->renderView($this->layout, $this->variables);
    }

    function content() {
        var_dump($this->_view);
        echo $this->renderView($this->_view, $this->variables);

        // var_dump("ha", $ha);
        // echo $ha;
        // Debugger::add("view", $view);
        // die($view);
        // include (ROOT . DS . 'application' . DS . 'views' . DS . $view . '.php');
    }

    function errors () {
        return $errors = Debugger::getAll();
    }

    function include ($path, $variables = []) {
        extract($variables);
        include (ROOT . DS . 'application' . DS . 'views'. DS . $path . '.php');
    }

    function view ($path, $data) {
        $this->_view = $path;
        $this->variables = $data;
    }

    function renderView ($path, $data) {
        var_dump($path);
        ob_start();
        extract($data, EXTR_SKIP);
        // We'll evaluate the contents of the view inside a try/catch block so we can
        // flush out any stray output that might get out before an error occurs or
        // an exception is thrown. This prevents any partial views from leaking.
        try {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $path . ".php");
        } catch (Exception $e) {
            // $this->handleViewException($e, $obLevel);
        } catch (Throwable $e) {
            // $this->handleViewException(new FatalThrowableError($e), $obLevel);
        }

        return ltrim(ob_get_clean());
    }
}
