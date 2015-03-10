<?php ob_start(); ?>
<html>
<head>
<?php
global $id;
include_once ("AdminCss.php");
$id=$_GET['id'];


 $obj = ORM::getInstance();
	$obj->setTable('products');
	$products= $obj->selectwhere("id",$id);
	for ($i = 0 ; $i < count($products) ; $i++){
      		foreach ($products[$i] as $key=>$value){

                          if($key=='id')
                       {
                         $id=$value;
                     
                       }

                           if($key=='name')
                       {
                         $oldName=$value;
                     
                       }
 

                           if($key=='price')
                       {
                         $oldPrice=$value;
                     
                       }

                            if($key=='category')
                       {
                         $oldSelect=$value;
                     
                       }




                             if($key=='image')
                       {
                         $oldImage=$value;
                     
                       }



}


}




?>       
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

 

 
</body>



    <form  method="post" enctype="multipart/form-data">




<h5><b>Product name:</b></h5><input type="text" name="name" id="name" class="form-control" value="<?php  echo $oldName;   ?>"/><br>
<h5><b>Price:</b></h5>  <INPUT  class="form-control" TYPE="NUMBER" MIN="0" MAX="100" STEP="2.5" name="price" id="price" value="<?php  echo $oldPrice;   ?>"/>
 <img src="<?php  echo '../uploads/'.$oldImage ;?>"  height="60" width="60"> 
<h5><b>Product Picture:</b></h5><input type="file" name="userfile" id="userfile" /><br><br>
<h5><b>Category:</b></h5>
<select id="mySelect" name="mySelect" class="form-control"><br><br>

<option selected ><?php  echo $oldSelect ?></option><br><br>

 </select>
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
#Nothing empty
$name=$_POST['name'];
$price=$_POST['price'];
$image=$_FILES['userfile']['name'];

$select=$_POST['mySelect'];

  $obj = ORM::getInstance();
		$obj->setTable('products');
		$query=$obj->update((array('name'=>$name , 'price'=>$price, 'category'=>$select ,'image'=>  
                $image, 'status'=>'available')),$id);
    unlink("../uploads/".$oldImage);

    header("Location:/PHP-Project/docs/All_Products.php");



  }
#Image is only empty
     	elseif(!empty($_POST['name'])  and !empty($_POST['price']) and !empty($_POST['mySelect'])   )
{
  
$name=$_POST['name'];
$price=$_POST['price'];
$image=$oldImage;
$select=$_POST['mySelect'];



  $obj = ORM::getInstance();
		$obj->setTable('products');
		$query=$obj->update((array('name'=>$name , 'price'=>$price, 'category'=>$select ,'image'=>  
                $image, 'status'=>'available')),$id);
     header("Location:/PHP-Project/docs/All_Products.php");
     

}
#all are empty
else
{
                     
		foreach($validation->errors as $error)

                {

			echo $error;
              
		}

	
}
}
   
?>


      		<input type="submit" name="submit" value="submit" class="btn btn-primary"/> 
     		<input type="reset" name="rest" value="Reset" class="btn btn-warning"/> <br> 

    </form>
</body>
</html>
<?php
ob_end_flush(); 
?>