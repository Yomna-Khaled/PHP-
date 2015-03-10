<?php
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
                               }

$id=$_GET['id'];
$obj = ORM::getInstance();
$obj->setTable("order_item");

$itemIds = $obj->selectwhere("orderId",$id);


$obj->setTable("orders");

$OrderInfos= $obj->selectwhere("id",$id);

    foreach ($OrderInfos as $key => $value) {
      $date[]=$value['date'];          

}







	 for ($i=0; $i <count($itemIds) ; $i++) { 
           $arr_id[]=$itemIds[$i]['itemId'].',';


            $arr_amount[]=$itemIds[$i]['amount'].',';


$obj->setTable("products");
	 		$OrderInfo = $obj->selectwhere("id",$itemIds[$i]['itemId']);
	 		foreach ($OrderInfo as $key => $value) {
                     




                          $names[]=$value['name'].',';
	                  $prices[]=$value['price'].',';



}
}


$IDs=implode("",$arr_id);


$amounts=implode("",$arr_amount);

$prices=implode("",$prices);

$names=implode("",$names);
$date=implode("",$date);
     header("Location: /PHP-Project/docs/edit.php?id=".$id."&IDs=".$IDs."&amounts=".$amounts."&prices=".$prices."&names=".$names."&Date=".$date);
                              
?>

