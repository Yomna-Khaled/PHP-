
<html>
<head>
	<title>Forget Password</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<style>
    

body{
  background-image: url("../static/logo.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: 100%;
  height: 100%;
  overflow: hidden;
}

.row{
  width: 1000px;
  margin-top: 150px;
  margin-left: 500px;
  background-color:rgba(192,192,192,0.8);
}

</style>


</head>
<body>
<?php


function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    } 

$flag = false;
$rules = array(
	'Email'=>'required%email',
  'answer'=>'required'
	);

$dataValidation =$_POST;

if (isset($_POST['submit'])) {
	
    $valid = new validation();
    $result = $valid->validate($dataValidation,$rules);
    if ($result== TRUE) {
    	$obj = ORM::getInstance();
		  $obj->setTable('users');
		  $user = $obj->selectAll();
		  foreach ($user as $key => $value) {
			 if ($value['email'] == $_POST['Email'] && $value['answer'] == $_POST['answer']) {
          $_SESSION['username'] = $value['username'];
          $_SESSION['image'] = $value["profileImg"];
          $_SESSION['id'] = $value["id"];
         
          header("Location: http://localhost/PHP-Project/docs/Add_User.php?id=".$value['id']);
				
			}else{
        $flag = true;  
      }
		}
    }else{
    	//display errors
    	$flagee = true;
    }

	
}


?>


<div class="container-fliud">
 <div class="row">

    <div class="col-md-8" style="width:1000px">

<h1 class="page-header"> Send Mail </h1>
<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" />
	<h5> <strong>Email : </strong></h5>
   <input type="text" class="form-control" placeholder="example@domain.com" name="Email" value=<?php 
 			  if (!empty($_POST["Email"]))
   				{
   					echo $_POST['Email'];
   				}
   				?>>
   				<br/>


    <h5> <strong>What is your GrandFather Work ? </strong></h5><br/>
   <input type="text" class="form-control" placeholder="answer" name="answer" value=<?php 
        if (!empty($_POST["answer"]))
          {
            echo $_POST['answer'];
          }
          ?>>
          <br/>      

<div class="form-group">
	
    <input type="submit" name="submit" style="float:right;margin-right:20px;" class="btn btn-primary" value="submit"> 
</div>
<?php
if ($flag == true) {
?>
<div class="alert alert-danger" role="alert" >Your info isnot valid </div>
<?php } ?>

<?php
if (isset($flagee)) {
  if ($flagee==true) {
    
  
?>
<div class="alert alert-danger" role="alert" >
<?php 
foreach($valid->errors as $error)
      {
        echo $error."<br/>";

      }
?>
</div>
<?php }} ?>


    

</form>
</div>
</div>
</div>
</body>
</html>