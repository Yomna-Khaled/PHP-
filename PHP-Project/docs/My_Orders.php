

<?php include_once ("UserCss.php");?>
<html>

<head>
<title> My Orders </title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


</head>


<body>

<div class="container">
 <div class="row">
    <div class="col-md-12" >
<h1 class="page-header"> My Orders </h1>

 



<script language="javascript" type="text/javascript">

var exampleSocket = new WebSocket("ws://127.0.0.1:8002");

exampleSocket.onmessage = function (event) {
       console.log("fe my orders user " + event.data);
       var value = event.data;
       var res = value.split(":");


       if(res[0] == "done"){
          console.log("hii");
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               
              document.getElementById("button"+res[1]).remove();
              document.getElementById("button1"+res[1]).remove();
              document.getElementById("status"+res[1]).innerHTML = "done";
             
     
            }
        }
        xmlhttp.open("GET","My_Orders.php?option="+event.data,true);
        xmlhttp.send();


       }

}

function deletePro(id){

  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              console.log("ok");
               exampleSocket.send("delete:"+id);
                document.getElementById(id).innerHTML = xmlhttp.responseText;
               
               
            }
        }
        xmlhttp.open("GET","cancel.php?id="+id,true);
        xmlhttp.send();
}





function GetDateFunction() {
  if (document.getElementById('old_table')) {
    document.getElementById('old_table').remove();  

    document.getElementById('sum').remove();
  };
	
	var ajaxRequest;  
	
 try{

   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
       
         alert("Your browser broke!");
         return false;
      }
   }
 }

 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){

      document.getElementById('demo').innerHTML = ajaxRequest.responseText;

   }
 }

 var from = document.getElementById('from').value;
 var to= document.getElementById('to').value;
 var queryString = "?from=" + from+" 00:00:00"+"&to="+to+" 23:59:59";
 
 ajaxRequest.open("GET", "My_Orders_1.php" + queryString, true);
 ajaxRequest.send(); 

}



function GetId(ID) {
	
	var ajaxRequest;  

  if(document.getElementById(ID).value=="+"){
   document.getElementById(ID).value="-";

	
 try{

   ajaxRequest = new XMLHttpRequest();
 }catch (e){
   
   try{
      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
   }catch (e) {
      try{
         ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
      }catch (e){
       
         alert("Your browser broke!");
         return false;
      }
   }
 }

 ajaxRequest.onreadystatechange = function(){
   if(ajaxRequest.readyState == 4){
      document.getElementById('div').innerHTML = ajaxRequest.responseText;
   }
 }
// var val = document.getElementById('d').value;
 ajaxRequest.open("GET", "My_Orders_2.php?id=" + ID, true);
 ajaxRequest.send(); 
}
else
document.getElementById(ID).value="+";
{
document.getElementById('div').innerHTML = "";
}
}




</script>

<div id="test">
<div class="col-md-5" >
<div class="input-group" >
  <span class="input-group-addon" id="basic-addon1">From</span>
   <input type="date" name="from" id="from" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" />

   </div>
</div>

<div class="col-md-5" >
<div class="input-group" >
  <span class="input-group-addon" id="basic-addon1">From</span>
     <input type="date" name="from" id="to" class="form-control" placeholder="example: 2015-01-01" aria-describedby="basic-addon1" />
  </div>
</div>

<div class="col-md-2" >
<div class="form-group">     
<button onclick="GetDateFunction()"  class="btn btn-primary">show</button>
 </div>
</div>

<div id="demo"> </div>


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


if(isset($_GET['option'])){
  $option = $_GET['option'];
  echo $option;
}                               

$obj = ORM::getInstance();
$obj->setTable('orders');

$orders = $obj->selectorders($_SESSION['id']);


	for ($i = 0 ; $i < count($orders) ; $i++){
      
          
      		foreach ($orders[$i] as $key=>$value){


    if($key=='id')
{$id=$value;


}


    if($key=='date')
{$date=$value;

?>

 <tr id="<?php echo $id ?>" >
<td class="text-center" ><?php echo $date; ?></td>

<td class="text-center" ><input type="button" id="<?php echo $id;?>" value="+" style="color:white" onclick="GetId(this.id)" style="font-size: 100 px;"  class="btn btn-warning"></td>

<?php } ?>

<?php 

 if($key=='status')
{
$status=$value;
?>
<td id="<?php echo "status".$id ?>"><?php echo $status; ?>
<?php
if($status=='processing')
{
?>
<td id="<?php echo "button".$id ?>" class="text-center" ><input id="<?php echo $id ?>" type="button"  value="Cancel" class="btn btn-danger" onclick="deletePro(<?php echo $id ?> )" />

<td id="<?php echo "button1".$id ?>" class="text-center" ><a href="edit_order.php?id=<?php echo $id ?>" class="btn btn-success">Edit</a></td>


<?php 
 // } 
  ?>

<?php
 
}

else
{
?>

<?php
}
}
?>
<?php
 if($key=='total')
{
$total=$value;
?>
<td class="text-center" ><?php echo $total;?></td>
</tr>
<?php
}
}
}

?>

<?php

$sum = $obj-> selectsumorders($_SESSION['id']);

	for ($i = 0 ; $i < count($sum) ; $i++){
          
      		foreach ($sum[$i] as $key=>$value){
?>

<?php
}
}
?>
</table>




<tr><div class="text-center" id="sum"><b><h1><span class="label label-info">TOTAL: <?php echo $value; ?> </span></h1><b></div>
</tr>

<div id="div"></div>
</div>
</div>

</body>
</html>
