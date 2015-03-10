
<?php
include_once('ORM.php');

  $status=$_GET['state'];
  $id=$_GET['id'];
      
  $obj = ORM::getInstance();
	$obj->setTable('products');

$query=$obj->update((array('status'=>$status)),$id);

?>
