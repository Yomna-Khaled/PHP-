<?php ob_start(); ?>
<html>
<head>
<?php
include_once ("AdminCss.php");
?>


<title> Add Product </title>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


   </head>
<body>

<div class="container">
 <div class="row">
    <div class="col-md-8" >
    <h1 class="page-header"> Add Product </h1>
 
    <form  class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">





    <h5> <strong> Product name: </strong></h5>
    <input type="text" name="name" id="name" class="form-control  has-error" id="inputError1" placeholder="Name"/><br>

    <h5><strong>Price:</strong></h5> 
     <INPUT  class="form-control" TYPE="NUMBER" MIN="0" MAX="100" STEP="2" name="price" id="price"/>
     </br>

    <h5><strong>Product Picture:</strong></h5>
      <input type="file" name="userfile" id="userfile" />
      </br>

    <h5><strong>Category:</strong></h5>
       <select id="mySelect" name="mySelect" class="form-control"></select>

<?php

function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
                               }
	$obj = ORM::getInstance();
	$obj->setTable('categries');
	$categories = $obj->selectAll();
	for ($i = 0 ; $i < count($categories ) ; $i++){
foreach ($categories[$i] as $key=>$value){

$optionArrays = explode("/", $value);

for($r=1;$r<count($optionArrays);$r++){


?>

<script>
default_option("<?php echo $optionArrays[$r] ?>");
function default_option(y)
{
    var old_option = document.createElement("option");
 
   old_option.setAttribute("id", "old");
    var r = document.createTextNode(y);
    old_option.appendChild(r);
    document.getElementById("mySelect").appendChild(old_option);

}



</script>
</select>


<?php
 
}
}
}
?>

<br/>

<a href="#" onclick="ajaxFunction()"  class="btn btn-info">Add Category</a>


<br/>
<script>

function ajaxFunction(){

//var cat=document.getElementById('cat').value;
var cat=prompt("enter category");
if(cat!=""){
 option(cat);
}
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
    
      var select=document.getElementById('mySelect').value;

   }

 }

 var x = document.getElementById("mySelect");
 console.log(x);
    var array = "";
    var i;
    for (i = 0; i < x.length; i++) {
        array = array+"/"+ x.options[i].text;
    }
    





var queryString = "?array=" + array ;
 ajaxRequest.open("GET", "Add_Product.php" + queryString, true);                              
 ajaxRequest.send(null);
 
 
}
function option(cat)
{
    var option = document.createElement("option");
 
    option.setAttribute("id", "op");
    var t = document.createTextNode(cat);
    option.appendChild(t);
    document.getElementById("mySelect").appendChild(option);

}



function saveCategories(){
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
      var ajaxDisplay = document.getElementById('ajaxDiv');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
var select=document.getElementById('mySelect').value;

   }

 }

 var x = document.getElementById("mySelect");
    var array = "";
    var i;
    for (i = 0; i < x.length; i++) {
        array = array+"/"+ x.options[i].text;
    }
    





var queryString = "?array=" + array ;
 ajaxRequest.open("GET", "Add_Product.php" + queryString, true);                              
 ajaxRequest.send(null);
 


}

</script>

<?php
	if($_POST)
	{

		require 'validation.php';
		$rules=array(
  		'name'=>'required',
  		'price'=>'required', 
  		'userfile'=>'exists', 
		);
		
	$validation=new Validation();
	if($validation->validate($_POST,$rules)==TRUE)
  {
      $name=$_POST['name'];
      $price=$_POST['price'];
      $image=$_FILES['userfile']['name'];
      $select=$_POST['mySelect'];

  $obj = ORM::getInstance();
		$obj->setTable('products');
		$query=$obj->insert(array('name'=>$name , 'price'=>$price, 'category'=>$select ,'image'=>  
                $image, 'status'=>'available'));


   header("Location:/PHP-Project/docs/All_Products.php");
  }
     	else
     	{  

      ?>

<br/>

<div class="alert alert-danger" role="alert">
 
    <?php 
    
     foreach($validation->errors as $error)
                {
            echo $error."<br/>";

          }

    ?>
</div>

      <?php                              
		   
	    }  
	}
?>

<br/><br/>
      <input type="submit" name="submit" value="submit" class="btn btn-primary"/> 
     	<input type="reset" name="rest" value="Reset" class="btn btn-warning"/> <br> 
      <input type="button" value="add" id="hide"   style="display : none;" /> 

             
    </form>


    <script >
var exampleSocket = new WebSocket("ws://127.0.0.1:8002");
    document.getElementById("hide").addEventListener("click" ,hhhh());

function hhhh(){
  var x  = "<?php echo $_POST['name']; ?>";
  alert(x);
  //   exampleSocket.send("product:"+ <?php echo "yoyo"?>);
}
    </script>
</body>
</html>
<?php
ob_end_flush(); 
?>
