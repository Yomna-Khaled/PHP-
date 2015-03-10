<?php 
     
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }

$obj = ORM::getInstance();
	$table1 = $obj->setTable('orders');
	$table2 = $obj->setTable1("users");
	$orders = $obj->join($table1,$table2 ,"userId","id");
	echo json_encode($orders);


?>