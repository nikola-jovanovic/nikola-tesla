<?php

/** Check if environment is development and display errors **/

function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors','On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    }
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
    $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
    return $value;
}

function removeMagicQuotes() {
    if ( get_magic_quotes_gpc() ) {
        $_GET    = stripSlashesDeep($_GET   );
        $_POST   = stripSlashesDeep($_POST  );
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/

function callHook() {
    $request = Request::createFromGlobals();
    Debugger::add("request", $request);
    // Debugger::add("bla", $bla);

    $router = Router::create($request);

    // require_once(ROOT . DS . 'application' . DS . 'routes.php');

    // $bla = file(ROOT . DS . 'application' . DS . 'routes.php');
    // var_dump($bla); die();

    $router->addRoute(Route::create("GET", "/", "HomeController", "index", "home.index"));
    $router->addRoute(Route::create("GET", "/naslovna", "HomeController", "index", "home.index"));
    $router->addRoute(Route::create("GET", "/items/viewall/([0-9]{1,6})", "ItemsController", "viewall", "items.viewall", ["id"]));
    $router->addRoute(Route::create("GET", "/items/([0-9]{1,6})", "ItemsController", "show", "items.view", ["id"]));
    $router->addRoute(Route::create("GET", "/items/([0-9]{1,6})/bla", "ItemsController", "show", "items.view.bla", ["id"]));
    $router->addRoute(Route::create("POST", "/items/add", "ItemsController", "add", "items.add"));

    $router->init();

    $factory = new ControllerFactory();

    $controller = $factory->createFromRouter($router);
    // var_dump($controller);
    if ($controller) {
        $controller->callAction($router->getAction(), $router->getParamsForAction());
    }

    // $controller->bla();
    // unset($controller);
}

require_once(ROOT . DS . 'library' . DS . 'controller' . DS . 'Controller.php');
require_once(ROOT . DS . 'library' . DS . 'controller' . DS . 'ControllerFactory.php');
require_once(ROOT . DS . 'library' . DS . 'model' . DS .  'Sql.php');
require_once(ROOT . DS . 'library' . DS . 'model' . DS .  'Model.php');
require_once(ROOT . DS . 'library' . DS . 'Template.class.php');
require_once(ROOT . DS . 'library' . DS . 'request' . DS . 'Request.php');
require_once(ROOT . DS . 'library' . DS . 'request' . DS . 'Post.php');
require_once(ROOT . DS . 'library' . DS . 'request' . DS . 'Get.php');
require_once(ROOT . DS . 'library' . DS . 'routing' . DS . 'Router.php');
require_once(ROOT . DS . 'library' . DS . 'routing' . DS . 'Route.php');
require_once(ROOT . DS . 'library' . DS . 'Debugger.php');


/** Autoload any classes that are required **/

function __autoload($className) {
    if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
        require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
    } else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
        require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
    } else {
        /* Error Generation Code Here */
    }
}

setReporting();
// removeMagicQuotes();
// unregisterGlobals();
callHook();
