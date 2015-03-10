<?php 
session_start();
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
session_destroy();
header("Location: http://localhost/PHP-Project/docs/Login.php")
?>