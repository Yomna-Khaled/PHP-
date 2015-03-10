<html>
<head>
<?php
//include_once ("AdminCss.php");
session_start();
?>

	<title> My Orders </title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</head>


<body>



<script>
     document.getElementById('div')= "";

</script>
 
<br><br><table class="table table-striped table-hover"  id="old_table">
<thead>

 <tr >
     
    <th class="text-center" >Date</th>
    <th class="text-center" >Details</th>
    <th class="text-center" >Status</th>
    <th class="text-center" >Action-Cancel</th>
    <th class="text-center" >Action-Edit</th>
    <th class="text-center" >Total</th>
</tr>
</thead>
 <?php 
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
                               }

$obj = ORM::getInstance();
$obj->setTable('orders');
$from=$_GET['from'];
$to=$_GET['to'];

	if($_GET['from']){
       
$orders = $obj->selectdates($from,$to,$_SESSION['id']);
if (!empty($orders)) {
 
	for ($i = 0 ; $i < count($orders) ; $i++){
      
          
      		foreach ($orders[$i] as $key=>$value){


    if($key=='id')
{$id=$value;


}


    if($key=='date')
{$date=$value;

?>

 <tr style="text-align:center">
<td><?php echo $date; ?>


</script>
<body>

<td class="text-center" ><input type="button" id="<?php echo $id;    ?>" value="+" style="color:white" onclick="GetId(this.id)" style="font-size: 100 px;"  class="btn btn-warning"></td>

</td>
 </td>

<?php } ?>

<?php 

 if($key=='status')
{
$status=$value;
?>
<td><?php echo $status; ?>
<?php
if($status=='processing')
{
?>

<td class="text-center" ><a href="cancel.php?id=<?php echo $id ?>" class="btn btn-danger">Cancel</a></td>

<td class="text-center" ><a href="edit_order.php?id=<?php echo $id ?>" class="btn btn-success">Edit</a></td>
<?php
 
}

else
{
?>
<td></td>
</td>
<?php
}
}
?>
<?php
 if($key=='total')
{
$total=$value;
?>
<td><?php echo $total;


 ?></td>
</tr>
<?php
}
}
}
}else{
  echo "empty table";
}
}
?>
<?php
$sum = $obj->selectsumdate($from,$to,$_SESSION['id']);





	for ($i = 0 ; $i < count($sum) ; $i++){
      
          
      		foreach ($sum[$i] as $key=>$value){
?>
<table>
<tr><div class="text-center" id="sum"><b><h1><span class="label label-info">TOTAL: <?php echo $value; ?> </span></h1><b></div>
</tr>

<?php
}
}

?>
</table>








<div id="div"></div>

</head>

</html>

