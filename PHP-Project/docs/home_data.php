
  <?php
  require "ORM.php";

  $arr1=$_GET['arr'] ;
  $arr2=$_GET['item'] ;

$item=(explode(",",$arr1));
$quantity=(explode(",",$arr2));

//$data['userId']=$_GET['userId'];
$data['date']=date("Y/m/d h:i:sa");
$data['status']='processing';
$data['total']=$_GET['total'];
$data['room']=$_GET['combo'];
$data['notes']=$_GET['notes'];

////////////////
$n=$_GET['userId'];
$t = ORM::getInstance();
$t->setTable('users');
$result=$t->getId($n);


foreach($result as $key=>$value)
{
	$data['userId']= $value['id'];
}

///////////////////

$t = ORM::getInstance();
$t->setTable('orders');
$result=$t->insert($data);

$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast();

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
?>
