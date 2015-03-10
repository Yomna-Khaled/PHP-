<html>
  <body>
<head>
<title>All Products</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script >
var exampleSocket = new WebSocket("ws://127.0.0.1:8002");

function status(id,name,price,image){
  var status;
  var state = document.getElementById(id).value;
  if (state == "available") {
    document.getElementById(id).value = "unavailable";
    status = "unavailable";
  }else{
    document.getElementById(id).value = "available";
    status = "available";
  }


  //send ajax request to the server
  if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(id).innerHTML = xmlhttp.responseText;
                exampleSocket.send("product:"+id+":"+status+":"+name+":"+price+":"+image);
               
            }
        }
        xmlhttp.open("GET","status.php?state="+status+"&id="+id,true);
        xmlhttp.send();

}


</script>

</head>

<body>

<?php
include_once("AdminCss.php");
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
                               }

	$obj = ORM::getInstance();
	$obj->setTable('products');
	$products = $obj->selectAll();

?>        

  
  <div class="container">
    <h1 class="page-header"> Products List </h1>
       

       <a href="Add_Product_Form.php"   class="btn btn-warning glyphicon glyphicon-plus" style="float:right"> Add Product</a>        
 
       <table class="table table-striped" >
    <thead>
      <tr>
        <th class="text-center" >Product</th>
        <th class="text-center" >Price</th>
        <th class="text-center" >Category</th> 
        <th class="text-center" >Image</th> 
        <th class="text-center" >status</th> 
        <th class="text-center" >Action-Edit</th>
        <th class="text-center" >Action-Delete</th>
      </tr>
    </thead>

      <tbody>
         
      	  <?php
      		foreach ($products as $key=>$value){
            $id = $value['id'];
?>
<tr>

            <td class="text-center" ><?php echo $value['name'] ?></td>

            <td class="text-center" ><?php echo $value['price']?></td>

            <td class="text-center" ><?php echo $value['category'] ?></td>
            <td class="text-center" ><img src="../uploads/<?php  echo $value['image']; ?>" height="60" width="60" class="img-rounded" ></td>

        
            <td class="text-center" ><input id="<?php echo $value['id'] ?>" type="button"  value="<?php echo $value['status']; ?>" class="btn btn-success" onclick="status(<?php echo $value['id'] ?> , <?php echo "'".$value['name']."'"?> , <?php echo $value['price'] ?>, <?php echo "'".$value['image']."'"?>)" />
            <td class="text-center" ><a href="Edit_Form.php?id=<?php echo $value['id'] ?>" class="btn btn-success" >Edit</a></td>
            <td class="text-center" ><a href="delete_product.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" >Delete</a></td>
</tr>
	  		                       	  	        
<?php
}
?>

    </tbody>

  </table>
</div>

  </div>

  </body>
</html>

