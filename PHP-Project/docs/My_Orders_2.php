<?php 
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
                               }

$obj = ORM::getInstance();
$obj->setTable("order_item");
	
$itemIds = $obj->selectwhere("orderId",$_GET['id']);


if (isset($_GET['id'])) {
		 for ($i=0; $i <count($itemIds) ; $i++) { 
	 		?>
	 		<div style="float:left" class="alert alert-success text-center" role="alert">
	 		<?php
	 		echo $itemIds[$i]['amount']."<br/>";
	 		$obj->setTable("products");
	 		$OrderInfo = $obj->selectwhere("id",$itemIds[$i]['itemId']);
	 		foreach ($OrderInfo as $key => $value) {
	 			
	 			?>
	 			<img src="../uploads/<?php echo $value['image']?> " class="img-circle" style="width:70px;height:70px;" >
<?php
				//echo "<br/>";
				echo $value['name']."<br/>";
	 			echo $value['price']." EGP"."<br/>";
	 			?>
	 			</div>
<?php	 			
        	}
	 }
}




?>


