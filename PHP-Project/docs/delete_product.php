<?php
 include_once('ORM.php');
 $obj = ORM::getInstance();
  $obj->setTable('products');
  $productInfo = $obj->selectwhere("id" , $_GET['id']);
  foreach ($productInfo as $key => $value) {
    unlink("../uploads/".$value['image']);
  }


	$id=$_GET['id'];
	$obj->setTable('products');
    $query = $obj->delete("id",$id);
    echo $query; 

    // $obj->setTable('order_item');
    // $query = $obj->delete("itemId",$id);
  

    header("Location: /PHP-Project/docs/All_Products.php");
?>
