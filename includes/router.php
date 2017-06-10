<?php
	// This controller routes all incoming requests to the appropriate controller
	//Automatically includes files containing classes that are called
	function __autoload($className){        
	   	    // file name
	    $file = 'classes/'.strtolower($className) . '.class.php';

	    if (file_exists($file)) {
	        //get file
	        include_once($file);        
	    }
	    else {
	        //file does not exist!
	        die("ne postoji");    
	    }
	}

	//fetch the passed request
	$request = $_SERVER['QUERY_STRING'];
	//parse the page request and other GET variables
	$parsed = explode('&' , $request);
	//the page is the first element
	$page = array_shift($parsed);
	//the rest of the array are get statements, parse them out.
	$getVars = array();
	foreach ($parsed as $argument){
	    //split GET vars along '=' symbol to separate variable, values
	    list($variable , $value) = explode('=' , $argument);
	    $getVars[$variable] = urldecode($value);
	}
?> 