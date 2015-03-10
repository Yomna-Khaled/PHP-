<!DOCTYPE html>
<html>
<head>


</head>
<body>
  <?php
require "ORM.php";
session_start();
  $arr1=$_GET['arr'] ;
  $arr2=$_GET['item'] ;

$item=(explode(",",$arr1));
$quantity=(explode(",",$arr2));


$data['userId']=$_SESSION['id'];
$data['date']=$_GET['Date'];
$data['status']='processing';
$data['total']=$_GET['total'];
$data['room']=$_GET['combo'];
$data['notes']=$_GET['notes'];


if($_GET['total']!=0)
{
$t = ORM::getInstance();
$t->setTable('orders');
$result=$t->update($data,$_GET['orderId']); /////////////////////////////////////
}



$t->setTable('order_item');

$resu=$t->delete("orderId",$_GET['orderId']);


for($i=0 ; $i<count($item) ; $i++)
{
 
 $d['orderId']= $_GET['orderId'];
 
 $d['itemId']= $item[$i];
 
 $d['amount']= $quantity[$i];

$t->setTable('order_item');

$resu=$t->insert($d); /////////////////////////// 
}




// $d['userId']=$_SESSION['id'];
// $d['amount']=$_GET['Date'];
// $d['itemId']=$_GET['total'];
// if($_GET['total']!=0)
// {
// $t = ORM::getInstance();
// $t->setTable('order_item');
// $result=$t->update1($d,$_GET['orderId']);

// }



?>

</body>
</html> 
