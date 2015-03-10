<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>home admin</title>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


<script>

var exampleSocket = new WebSocket("ws://127.0.0.1:8002");
/************/
exampleSocket.onmessage = function (event) {
    
    console.log("HomeAdmin="+event.data);
    var msg = event.data;
    res = msg.split(":");
   
    //put code for ajax to get last id of order and display it in page 
    if (res[0] == "Order") {
        var table = document.getElementById("table");
        var row = table.insertRow(1);

        var div = document.createElement('div');
        div.setAttribute('class' , "alert alert-success");
        div.innerHTML = "YOU HAVE A NEW ORDER ... PLEASE REFREASH PAGE :D";
        var button = document.createElement('button');
        button.setAttribute("class" , "btn btn-warning")
        var t = document.createTextNode("CLICK ME");       
        button.appendChild(t); 
        button.addEventListener("click",function(){
          window.location.reload();
        });
        

        div.appendChild(button);
        row.appendChild(div);

        }
        if(res[0] == "delete"){
          console.log("id="+res[1]);
          document.getElementById(res[1]).remove();
          document.getElementById("image"+res[1]).remove();
          
        }

    
 }


	function getStatus(option,orderId) {
    var value = option.value;
    console.log("orderId="+orderId);
    console.log("value="+value);
    
    if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  document.getElementById(orderId).remove();
                  document.getElementById("image"+orderId).remove();

            	    exampleSocket.send(value+":"+orderId);
                 //document.getElementById("ty").innerHTML = xmlhttp.responseText;
                 //window.location.reload();
            }
        }
       
        	xmlhttp.open("GET","HomeAdmin.php?id="+orderId+"&opt="+value,true);
	        xmlhttp.send();
}



</script>



</head>
<body >
<?php 
  
include_once("AdminCss.php");


if (isset($_SESSION['username']) && isset($_SESSION['image'])) {
      
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }






 if (isset($_GET['id']) && isset($_GET['opt'])) {

	$orderId = $_GET['id'];
	$option = $_GET['opt'];

	$obj = ORM::getInstance();
	$table1 = $obj->setTable('orders');

	$data = array('status'=> $option);
	$obj->update($data,$orderId);

	
  }
 
 else{

	$obj = ORM::getInstance();
	$table1 = $obj->setTable('orders');
	$table2 = $obj->setTable1("users");
	$orders = $obj->join($table1,$table2 ,"userId","id");
	
?>


<div class="container">
  <h2>Order List</h2>
<div id="tab">         
  <table class="table table-striped" id="table">
    <thead>
      <tr>
        <th class="text-center" >Order Date</th>
        <th class="text-center" >Name</th>
        <th class="text-center" >Room</th>
        <th class="text-center" >Total Order(LE)</th>
        <th class="text-center" >Action</th>

      </tr>
    </thead>




    <tbody>
    <?php
    $temp = array();

     foreach ($orders as $key => $value) {
    	
    		if ($value['status'] != "done") {
    	    // function to check if id exists in order item or not 
      //    if (checkIfExists($value['id']) == true) {
        //    echo "sdhfjsdhfsjdfhsjdfksdfskdfsdfhksafhksdhfskjdfhaskdfh";
        
    ?>
      <tr id="<?php echo $value['id']?>">
        <td class="text-center" ><?php echo $value['date'];?></td>
        <td class="text-center" ><?php echo $value['room'];?></td>
        <td class="text-center"> <?php echo $value['username']?> </td>
	    	<td class="text-center"> <?php echo $value['total']?> </td>
        <td>
		    <select class="form-control input-m" onchange="getStatus(this,<?php echo $value['id']?>)">
		       
		       <option value="processing">processing</option>
			   <option value="on the way">on the way </option>
		       <option value="done">deliverd</option>
		    </select>
        </td>
        
      </tr>
      <td id="<?php echo "image".$value['id']?>">
     <!--  <div class="alert alert-success" role="alert" > -->
     <?php 
     	 	
			$obj->setTable("order_item");
			$itemIds = $obj->selectwhere("orderId",$value['id']);
			for ($i=0; $i <count($itemIds) ; $i++) { 
				?>

			
	 		<?php
	 		$obj->setTable("products");
	 		$OrderInfo = $obj->selectwhere("id",$itemIds[$i]['itemId']);
    
	 		foreach ($OrderInfo as $key => $value) {
	 			
	 			?>
	 		<div  class="alert alert-success list-group-item media-left" style="float:left" role="alert">
	 		
	 		<span class="badge text-center"><?php echo $itemIds[$i]['amount']."  "; ?></span> 
	 		
	 		<img src="../uploads/<?php echo $value['image']?> " class="img-circle" style="width:70px;height:70px;" >
			
<?php
				echo "<br/>";
				echo $value['name']."<br/>";
	 			echo $value['price']." LE"."<br/>";
	 			
		}
  

     ?>
   <!--   </div> -->
      </div>
  <?php 

	
  }}//}

 } ////////////////


  }//else closing


  }else{ // closing session condition

    header("Location: http://localhost/PHP-Project/docs/Login.php");

    }  ?>    
      </td>
    </tbody>
  </table>

</div> 

  <div id="ty"></div>
</div>

</body>
</html>

<?php 
function checkIfExists($id)
{
    // check if item in otder_item
    $obj = ORM::getInstance();
    $obj->setTable('order_item');
    $arr = $obj->selectwhere('itemId', $id);
    if (empty($arr)) {
      $obj->setTable('orders');
      $obj->delete("id", $id);
      return false;
    }
    return true;
}
?>

<?php
ob_end_flush(); 
?>
