<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
$(function() {
$( "#datepicker" ).datepicker();
$( "#datepicker1" ).datepicker();
});
</script>
</head>
<body>
<p> start Date: <input type="text" id="datepicker" ></p>
<input type="button" name="get" value="get" onclick="getv()">
<p> end Date: <input type="text" id="datepicker1" ></p>

<script>
function getv(){
elem=document.getElementById('datepicker');
console.log(elem.value);
}
</script>


</body>
</html>