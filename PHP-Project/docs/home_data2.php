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
$data['date']=date("Y/m/d h:i:sa");
$data['status']='processing';
$data['total']=$_GET['total'];
$data['room']=$_GET['combo'];
$data['notes']=$_GET['notes'];


if($_GET['total']!=0)
{
$t = ORM::getInstance();
$t->setTable('orders');
$result=$t->insert($data);

$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast1($_SESSION['id']);

$t = ORM::getInstance();


for($i=0 ; $i<count($item) ; $i++)
{
foreach($r as $key=>$value)
{
 $d['orderId']= $value['id'];
 }
 $d['itemId']= $item[$i];
 
 $d['amount']= $quantity[$i];

$t->setTable('order_item');

$resu=$t->insert($d);
}
}


$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast1($_SESSION['id']);
foreach($r as $key=>$value)
{
	$item_last=$value['id'];
}
 $t->setTable('order_item');
 $r=$t->selectspecial($item_last);
//echo $r;
{
foreach($r as $key=>$value)
{
 $iteme_last= $value['itemId'];
$t = ORM::getInstance();
 $t->setTable('products');
$r=$t->selectWhere("id",$iteme_last);
foreach($r as $key=>$value)

{
 $img= $value['image'];
 $n= $value['name'];
?>
  <img src="../uploads/<?php echo $value['image'] ?>" height="100" width="100" >
<?php
echo $n;  


}

}
echo "<br><br>";
echo "------------------------------------------------------------------------------------------------------------------------------
";
}

?>

</body>
</html> 

