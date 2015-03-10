<?php 
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
$obj = ORM::getInstance();
$obj->setTable("order_item");
$OrderInfo = $obj->selectwhere("orderId",$_GET['id']);


echo json_encode($OrderInfo);

?>