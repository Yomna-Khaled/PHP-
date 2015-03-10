<?php
 include_once('ORM.php');
$id=$_GET['id'];

	$obj = ORM::getInstance();
	$obj->setTable('orders');
        $query = $obj->delete("id",$id);

?>
