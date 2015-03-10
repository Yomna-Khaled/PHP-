<!doctype html>
<html lang="en">
<head>
	<title>Checks</title>
<meta charset="utf-8">

 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<style >
  
.dis{
  margin-top: 100px;

}

</style>



<script >
	function showOrders(userID){

     if(document.getElementById("1").value=="-"){
          document.getElementById("1").value="+";
          console.log("ana fe el -");
          document.getElementById("table").remove();

      }else if(document.getElementById("1").value=="+"){
          document.getElementById("1").value="-";
        
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
               //  document.getElementById("display").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","Checks.php?q="+userID,true);
        xmlhttp.send();
	}
}



	function order(ID){

   if(document.getElementById(ID).value=="-"){
          document.getElementById(ID).value="+";
          console.log("ana fe el -");
          document.getElementById("ord").remove();

      }else if(document.getElementById(ID).value=="+"){
          document.getElementById(ID).value="-";
        

		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               
                document.getElementById("orderr").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","Checks.php?order="+ID,true);
        xmlhttp.send();
	}
}
	function display(){
		if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               
                document.getElementById("display").innerHTML = xmlhttp.responseText;
                //window.location.reload();
            }
        }
        console.log(document.getElementById('from'));
        var from = document.getElementById('from').value;
        from = from+" 00:00:00";
        
        console.log(from);
        console.log(to);
         console.log(document.getElementById('to'));
        var to = document.getElementById('to').value;
        to = to+" 23:59:59";
        xmlhttp.open("GET","Checks.php?from="+from+"&to="+to+"&flag=true",true);
        xmlhttp.send();
	}


</script>
</head>
<body>


<?php 
//session_start();

function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
    
  //case of pressing on the + button  
$flag = "false";
if (isset($_GET['q']) ) {

$obj = ORM::getInstance();
	$obj->setTable('orders');
  session_start();
  $userOrders = $obj->selectDate("userId" , $_GET['q'] , $_SESSION['from'], $_SESSION['to']);
	
}elseif (isset($_GET['order'])) {

	$obj = ORM::getInstance();
	$obj->setTable("order_item");
	$itemIds = $obj->selectwhere("orderId",$_GET['order']);

}elseif (isset($_GET['to']) && isset($_GET['from']) && $_GET['flag']=="true") {
	
	$obj = ORM::getInstance();
	$from = $_GET['from'];
	$to = $_GET['to'];

	$table1 = $obj->setTable('users');
	$table2 = $obj->setTable1('orders');
	$pk = "id";
	$fk = "userId";
  
   $users = $obj->joinDateGroupBy($table1,$table2 , $pk , $fk,$fk , $from , $to);


}
else{
include_once ("AdminCss.php");
?>


<div class="container">
  <div class="col-md-12" >
  <h1 class="page-header">  Checks </h1>


<div>

<div class="col-md-5" >
<div class="input-group" >
  <span class="input-group-addon" id="basic-addon1">From</span>

  <input type="date" name="from" id="from" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" />
  <!-- 
  <input id="from" type="text" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" name="from">
 --></div>
</div>


<div class="col-md-5" >
<div class="input-group">
  <span class="input-group-addon" id="basic-addon1">To</span>
   <input type="date" name="to" id="to" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" />
 <!-- 
  <input id="to" type="text" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" name="to">
 -->
 </div>
</div>

<div class="col-md-2" >
<div class="form-group">
    <input type="submit" name="submit" value="show" class="btn btn-primary"  onclick="display()"> 
</div>
</div>
</div>

<?php } ?>

<div id="display" class="dis">
<?php 
if (isset($_GET['to']) && isset($_GET['from'])) {
    $_SESSION['from'] = $_GET['from'];
    $_SESSION['to'] = $_GET['to'];
?>

<table class="table table-striped table-hover" >
    
      <tr>
        <th class="text-center" >User Name</th>
        <th class="text-center" >Amount</th>
      </tr>
<tbody>
<?php
if ($users != NULL) {

    foreach ($users as $key => $value) {
      if ($value['type'] != "admin") {
              
?>
<tr>
    <td  class="text-center warning" ><?php echo $value['username'] ?><input type="button"  id="1" value="+" class="btn btn-warning" style="float:right"  style="font-size: 100px;" onclick="showOrders(<?php echo $value['userId'] ?>)">
    </td>
    <td class="text-center warning" ><?php echo $value['sum(total)'] ?></td>
</tr>

<?php
  }
  }
}else{
  echo "Table is empty";
}
}

?>
</tbody>
</div>


<div id="txtHint" class="hint">

<?php 
if (isset($_GET['q'])) {
	
?>
  <table id="table" class="table table-striped table-hover" >
    
      <tr>
        <th class="text-center" >Date</th>
        <th class="text-center" >Amount</th>
      </tr>
<tbody>
<?php foreach ($userOrders as $key => $value) {

?>
 <tr>
    <td class="text-center warning" ><?php echo $value['date'] ?><input type="button" id="<?php echo $value['id'] ?>" value="+" class="btn btn-warning " style="float:right" onclick="order(<?php echo $value['id'] ?>)">
 		</td>
		<td class="text-center warning" ><?php echo $value['total'] ?></td>
</tr>

<?php 
}
}

?>

</tbody>
</table>
</div>





<div id="orderr" >
<div id="ord">
<?php 
	if (isset($_GET['order'])) {
		 for ($i=0; $i <count($itemIds) ; $i++) { 
	 		?>
	 		<div style="float:left" class="alert alert-success text-center" role="alert" style="width:90px;height:100px;">
	 		
	 		<span class="badge text-center"><?php echo $itemIds[$i]['amount']."  "; ?></span> 
	 		
	 		<?php
	 	
	 		$obj->setTable("products");
	 		$OrderInfo = $obj->selectwhere("id",$itemIds[$i]['itemId']);
	 		foreach ($OrderInfo as $key => $value) {
	 			
	 			?>
	 			<img src="../uploads/<?php echo $value['image']?> " class="img-circle" style="width:70px;height:70px;" >
<?php
				echo "<br/>";
				echo "<br/>";
			
	 			?>
	 			<h3><span class="label label-info"><?php echo $value['name']."<br/>"?></span></h3>
	 			<span class="badge label label-warning"><?php echo $value['price']." LE"."<br/>"?> </span>
</div>
<?php	 			
        	}
	 }
}
?>
</div>
</div>

</div>

</div>

</body>
</html>