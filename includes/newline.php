<?php

function newline($string) 
{ 
    return preg_replace("/(\r\n)+|(\n|\r)+/", "<br/><br/>", $string); 
} 

?>