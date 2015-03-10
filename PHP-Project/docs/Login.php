
<html>
<head>
	<title>Login</title>
	
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1">
	 	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


		<script type="text/javascript" src="animatedPopup.js"></script>

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
	background-color:rgba(192,192,255,0.8);
}
</style>
</head>

<body>

<div class="container-fliud">


<?php
function __autoload($classname) {
    $filename =  $classname .".php";
    include_once($filename);
    }
$error = false;
$dataValidation = $_POST;

	$rules = array(
		'email' => 'required%email',
		'password' => 'required'
		);


if (isset($_POST['submit'])) {

	$valid = new validation();
    $val = $valid->validate($dataValidation,$rules);
    if ($val == TRUE) {

 	$obj = ORM::getInstance();
	$obj->setTable('users');

	$result = $obj->selectAll();
	foreach ($result as $key => $value) {
		if ($value['email'] == $_POST['email']) {
			if ($value['password'] === md5($_POST['password'])) {
				
				session_start();
				$_SESSION['username'] = $value["username"];
				$_SESSION['image'] = $value["profileImg"];
				$_SESSION['id'] = $value["id"];

				echo "<p class='navbar-text'>Signed in as Mark Otto</p>";
				if ($value['type'] == "normal") {
					//redirect to the user home page
					header("Location: http://localhost/PHP-Project/docs/home.php");
					
				}else{					
					header("Location: http://localhost/PHP-Project/docs/HomeAdmin.php");
					//redirect to the admin home page
				}
				
			}else {
				// password is incorrect
				$flag = true;
				
			}
		}
	}

}else{
	//if validation have an error
	$error = true;
}
}
?>

 <div class="row">


    <div class="col-md-8" style="width:1000px">
		<h1 class="page-header"> Welcome to Cafe </h1>
		<form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data" />
			<h5> <strong> Email : </strong></h5>
				<input type="text" class="form-control  has-error" placeholder="example@domain.com" name="email" value=<?php 
						 if (!empty($_POST["email"]))
				   		{
				   				echo $_POST['email'];
				   		}
?>>

		<h5> <strong>password : </strong></h5>
   <input type="password" class="form-control" placeholder="password" name="password">
   <br/>

<div class="form-group">
<a href="http://localhost/PHP-Project/docs/Forget_Password.php" style="margin-left:20px; margin-top:20px;"><font size="0.5">Forget password?</font></a>
 			
 <input type="submit" name="submit" class="btn btn-primary" style="float:right" value="submit"> 
</div>
<?php 
if (isset($flag) && $flag==true) {
?>
<div class="alert alert-danger" role="alert" > Your password isnot valid </div>

<?php  } ?>

<?php 
if (isset($error) && $error==true) {
?>
<div class="alert alert-danger" role="alert" > 
<?php 
foreach($valid->errors as $error)
 {
			  echo $error."<br/>";
 }
?>

 </div>

<?php  } ?>


<script >
	
	alert(<?php echo "yoyo"; ?>);
</script>


</form>
    </div>
 </div>




 </div>


}

</body>
</html>