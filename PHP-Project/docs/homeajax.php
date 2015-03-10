<?php
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }


    // $query = "select * from products , (select * from order_item , (select users.id as USERID , room , username , orders.id as OID , date , status , total  from users ,
    //  orders where users.id = orders.userId) as t where order_item.orderId = t.OID) as y where products.id = y.itemId order by  orderId;";
      
    //      $result = mysqli_query($this->dbconn,$query); 
      
    //     for($i=0; $i < $this->dbconn->affected_rows ; $i++){
    //         $row = mysqli_fetch_assoc($result);
    //         $users[]=$row; 
    //     } 
        //var_dump($users);
        
    
    $obj = ORM::getInstance();
	$y = $obj->yy();
	// $table1 = $obj->setTable('orders');
	// $table2 = $obj->setTable1("users");
	// $orders = $obj->join($table1,$table2 ,"userId","id");



// 	  foreach ($orders as $key => $value) {
// 	  	foreach ($value as $key1 => $value1) {
// 	  		if($key1=="id"){
// 	  			$id[]=$value1;
// 	  		}
// 	  		if($key1=="userId"){
// 	  			$user[]=$value1;
// 	  		}
// 	  		if($key1=="date"){
// 	  			$date[]=$value1;
// 	  		}
// 	  		if($key1=="status"){
// 	  			$status[]=$value1;
// 	  		}
// 	  		if($key1=="total"){
// 	  			$total[]=$value1;
// 	  		}
// 	  		if($key1=="room"){
// 	  			$room[]=$value1;
// 	  		}

// 	  	}


//    }
    
//    	foreach ($id as $key => $value) {
// 		$itemIds[] = $value;

//    }



// $obj->setTable("order_item");
//  for ($i=0; $i < count($itemIds); $i++) { 
//  	$OrderInfo = $obj->selectwhere("orderId",$itemIds[$i]);
//  	foreach ($OrderInfo as $key => $value) {
//  		if ($key == "amount"){
//  			$amount[] = $value;
//  		}
//  		if ($key == "itemId"){
//  			$itemId[] = $value;
//  		}
//  	}
// }


// $obj->setTable("products");
//  for ($i=0; $i < count($itemId); $i++) {
//  	$prod = $itemId[$i]["itemId"];
//  	$yy[][0] = "uuu";
//  	$yy[][1] = "100";

 	
//  }

//    $array=array();
//    $array['id']=$id;
//    $array['user']=$user;
//    $array['date']=$date;
//    $array['status']=$status;
//    $array['total']=$total;
//    $array['room']=$room;
//    $array['itemId']=$itemIds;
//    $array['amount']=$amount;
//    $array['product']=$yy;
//    // $array['itemName']=$itemName;
   // $array['itemImage']=$itemImage;
   // $array['itemPrice']=$itemPrice;

	echo json_encode($y);


    ?>
