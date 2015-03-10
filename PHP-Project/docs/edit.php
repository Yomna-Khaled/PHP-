<html>
<head>

<?php 
include_once ("UserCss.php");

?>

<style>

#header1 {

    border:2px solid black;
    margin-right:10px;
    float:left;


    background-color:white  ;
    color:black;
   
    padding:5px;
    width:30%;
   height: 500px;
}
</style>


</head>

<body>
<div class="container-fluid">
 <div class="row " >
<h1 class="page-header"> Order </h1>

<div class="col-md-5" id="left">


<table id="f" class="table table-striped table-bordered table-hover" style="height:300px 100%">
 
  <thead>
    
      <th class="text-center"> Item </th>
      <th class="text-center"> Amount </th>
      <th class="text-center"> Add </th>
      <th class="text-center"> Dec </th>
      <th class="text-center"> Price </th>
      <th class="text-center"> Remove </th>
    

  </thead>


</table>
<?php 
require "ORM.php";
session_start();

$t = ORM::getInstance();
$t->setTable('products');


echo " <br> <legend>Making order</legend>";
echo "<br> <br> " ;


$t->setTable('users');



?>



</form>
<div>
<textarea id="notes" rows='4' cols='30' onfocus="if (this.innerHTML=='Write your notes here .. ') this.value = '';">Write your notes here .. </textarea>
<br> <br>
Room :
 <select  id="combo">
  <option value="<?php $t = ORM::getInstance();
 $t->setTable('users'); 
  $result=$t->selectwhere("id",$_SESSION['id']);
 foreach($result as $key=>$value)
{
    $room=$value['roomNum'];
    echo $room;
}  ?>"> <?php $t = ORM::getInstance();
 $t->setTable('users');
 $result=$t->selectwhere("id",$_SESSION['id']);
 foreach($result as $key=>$value)
{
$room=$value['roomNum'];
    echo $room;


}  ?></option>
<?php
$t = ORM::getInstance();
$t->setTable("users");
$rooms = $t->selectdistinct('type',"'normal'");
foreach ($rooms as $key => $value) {
  if($room !=$value['roomNum']){
  ?>

  <option value=<?php echo $value['roomNum']; ?>> <?php echo $value['roomNum']; ?></option>
<?php } }?>
</select> 
<br> <br>
--------------------------------------
<br>

<div id="total">

</div>

<br>
<input type='submit' value='confirm' onclick='confirm()'>
<br><br>
</div> 
<div id="sucsess"> 
</div>


</div>
<div id="header2">
<div id="header3">
Last order :
<?php 
$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast();

foreach($r as $key=>$value)
{
 $item_last= $value['id'];

}


$t = ORM::getInstance();
 $t->setTable('order_item');
$r=$t->selectspecial($item_last);
//echo $r;
{
foreach($r as $key=>$value)
{
 $iteme_last= $value['itemId'];
$t = ORM::getInstance();
 $t->setTable('products');
$r=$t->selectWhere("id",$iteme_last);
foreach($r as $key=>$value)

{
 $img= $value['image'];
 $n= $value['name'];
?>
  <img src="../uploads/<?php echo $value['image'] ?>" height="100" width="100" >
<?php
echo $n;  

}

}
}
echo "<br><br>";
?>
------------------------------------------------------------------------------------------------------------------------------
<br>
</div>

<?php
//include "db1.php";
$t->setTable('products');
$result=$t->selectwhere('status',"'available'");


foreach($result as $key=>$value)
{$i= $value['id'];
 $n= $value['price'];
$name=$value['name'];

 

?>
  <img src="../uploads/<?php echo $value['image'] ?>" height="100" width="100" onclick="myFunction(<?php echo $i?>,<?php echo $n?>,<?php echo "'".$name."'"?>)">

<?php
  echo $name." "; 
echo $n."LE";
}

?>
</div>


</div>

<script> 
var arr = [];

var item = new Array();

var count = new Array();
var fol;

var flag=1;
var id=0;
total=0;

<?php 
    $id= $_GET['id'];
$ids= $_GET['IDs'];
    $ids= (explode(",",$ids));
    $number = count($ids)-1;
$amounts= $_GET['amounts'];
     $amounts= (explode(",",$amounts));
$names=$_GET['names'];
     $names= (explode(",",$names));
$prices=$_GET['prices'];
     $prices= (explode(",",$prices));
$Date=$_GET['Date'];

?>
// console.log (<?php echo $id; ?>);
// console.log (<?php echo $ids[1]; ?>);
 console.log (<?php echo $number; ?>);
// console.log (<?php echo $amounts[1]; ?>);

<?php
// $item_numbers=[1,2,4];

// $arr_amount=[2,1,3];
// $names=['tea','coffee','lemon'];
// $prices=[3,3,5];

for($i=0 ;$i< $number; $i++)
{
?>
fn1(<?php echo $ids[$i]; ?>,<?php echo $prices[$i]; ?> ,<?php echo "'$names[$i]'"; ?> ,<?php echo $amounts[$i]; ?>);

<?php

}

?>

//////////////////////////




function fn1(itemId,price,name,amount)
{
total=total+price*amount;


var flag=1;

if(flag==1)
{
arr[arr.length]=itemId;

var newDiv = document.createElement("div"); 
var newDiv2 = document.createElement("div"); 
var newDiv4 = document.createElement("img"); 
var newDiv5 = document.createElement("img"); 
var newDiv6 = document.createElement("img"); 

newDiv4.setAttribute('src','../uploads/plus.png');
newDiv5.setAttribute('src','../uploads/minus.png');
newDiv6.setAttribute('src','../uploads/close.png');

newDiv6.setAttribute('id',itemId+'close');

newDiv5.setAttribute('id',itemId+'minus');
newDiv.setAttribute('id',itemId+'name');

newDiv4.setAttribute('id',itemId+'plus');
newDiv2.setAttribute('name',itemId);

var newDiv3 = document.createElement("div"); 
newDiv3.setAttribute('id',itemId);


count[itemId]=amount;

newDiv.setAttribute('style', 'float:left');
newDiv3.setAttribute('style', 'float:left');
newDiv4.setAttribute('style', 'float:left');
newDiv5.setAttribute('style', 'float:left');
newDiv2.setAttribute('style', 'float:left');
newDiv6.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');

newDiv4.setAttribute('height', '20px');
newDiv5.setAttribute('height', '20px');
newDiv4.setAttribute('width', '20px');
newDiv5.setAttribute('width', '20px');
newDiv6.setAttribute('height', '20px');
newDiv6.setAttribute('width', '20px');
newDiv5.onclick = function() { if(count[itemId]>=2){count[itemId]--; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total=total-price;
document.getElementById("total").innerHTML="Total: "+total+"LE";

}};

newDiv6.onclick = function() { 

for(i=0 ; i< arr.length ; i++)

{
if(arr[i]==itemId)
{
 arr.splice(i,1); 
}

}

element=document.getElementById(itemId);
element.remove();

l=document.getElementsByName(itemId)[0].innerHTML;
l = l.split(":")[1]; 
total=total-l;
document.getElementById("total").innerHTML="Total: "+total+"LE";

//console.log(total);
element = document.getElementsByName(itemId)[0];
element.remove();
element = document.getElementById(itemId+'minus');
element.remove();
element = document.getElementById(itemId+'plus');
element.remove();
element = document.getElementById(itemId+'name');
element.remove();
element = document.getElementById(itemId+'close');
element.remove();
};


newDiv4.onclick = function() { count[itemId]++; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total= total+price;
document.getElementById("total").innerHTML="Total: "+total+"LE";


};
  var newContent = document.createTextNode(name+" >> "); 
  var newContent2 = document.createTextNode("Price:"+price*count[itemId]); 
  var newContent3 = document.createTextNode(count[itemId]); 
  newDiv.appendChild(newContent);
  newDiv2.appendChild(newContent2);
  newDiv3.appendChild(newContent3);
   // newDiv4.appendChild(newContent4);

  document.getElementById("f").appendChild(newDiv); //name
  document.getElementById("f").appendChild(newDiv3); //quantity
    document.getElementById("f").appendChild(newDiv4); //plus
      document.getElementById("f").appendChild(newDiv5); //minus

  document.getElementById("f").appendChild(newDiv2); //price
document.getElementById("f").appendChild(newDiv6);
  
flag=0;


}


document.getElementById("total").innerHTML="Total: "+total+"LE";

}






////////////////////

var fol;

var flag=1;
// var id=0;
// total=0;
// var arr = [];
// var name1="bj";

// var item = new Array();

// var count = new Array();


function myFunction(itemId,price,name)
{
total=total+price;


var flag=1;
for (var i = 0; i < arr.length; i++) {

    if(arr[i]==itemId)
{
flag=0;
console.log("tea found");
count[itemId]++;
p=price*count[itemId];
document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+p;
}
 else
 console.log("tea not found"); 


}

if(flag==1)
{
arr[arr.length]=itemId;

var newDiv = document.createElement("div"); 
var newDiv2 = document.createElement("div"); 
var newDiv4 = document.createElement("img"); 
var newDiv5 = document.createElement("img"); 
var newDiv6 = document.createElement("img"); 

newDiv4.setAttribute('src','../uploads/plus.png');
newDiv5.setAttribute('src','../uploads/minus.png');
newDiv6.setAttribute('src','../uploads/close.png');

newDiv6.setAttribute('id',itemId+'close');

newDiv5.setAttribute('id',itemId+'minus');
newDiv.setAttribute('id',itemId+'name');

newDiv4.setAttribute('id',itemId+'plus');
newDiv2.setAttribute('name',itemId);

var newDiv3 = document.createElement("div"); 
newDiv3.setAttribute('id',itemId);


count[itemId]=1;

newDiv.setAttribute('style', 'float:left');
newDiv3.setAttribute('style', 'float:left');
newDiv4.setAttribute('style', 'float:left');
newDiv5.setAttribute('style', 'float:left');
newDiv2.setAttribute('style', 'float:left');
newDiv6.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');

newDiv4.setAttribute('height', '20px');
newDiv5.setAttribute('height', '20px');
newDiv4.setAttribute('width', '20px');
newDiv5.setAttribute('width', '20px');
newDiv6.setAttribute('height', '20px');
newDiv6.setAttribute('width', '20px');
newDiv5.onclick = function() { if(count[itemId]>=2){count[itemId]--; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total=total-price;
document.getElementById("total").innerHTML="Total: "+total+"LE";

}};

newDiv6.onclick = function() { 

for(i=0 ; i< arr.length ; i++)

{
if(arr[i]==itemId)
{
 arr.splice(i,1); 
}

}

element=document.getElementById(itemId);
element.remove();

l=document.getElementsByName(itemId)[0].innerHTML;
l = l.split(":")[1]; 
total=total-l;
document.getElementById("total").innerHTML="Total: "+total+"LE";

//console.log(total);
element = document.getElementsByName(itemId)[0];
element.remove();
element = document.getElementById(itemId+'minus');
element.remove();
element = document.getElementById(itemId+'plus');
element.remove();
element = document.getElementById(itemId+'name');
element.remove();
element = document.getElementById(itemId+'close');
element.remove();
};


newDiv4.onclick = function() { count[itemId]++; document.getElementById(itemId).innerHTML=count[itemId];
document.getElementsByName(itemId)[0].innerHTML="Price:"+price*count[itemId];
total= total+price;
document.getElementById("total").innerHTML="Total: "+total+"LE";


};
  var newContent = document.createTextNode(name+" >> "); 
  var newContent2 = document.createTextNode("Price:"+price*count[itemId]); 
  var newContent3 = document.createTextNode(count[itemId]); 
  newDiv.appendChild(newContent);
  newDiv2.appendChild(newContent2);
  newDiv3.appendChild(newContent3);
   // newDiv4.appendChild(newContent4);

  document.getElementById("f").appendChild(newDiv); //name
  document.getElementById("f").appendChild(newDiv3); //quantity
    document.getElementById("f").appendChild(newDiv4); //plus
      document.getElementById("f").appendChild(newDiv5); //minus

  document.getElementById("f").appendChild(newDiv2); //price
document.getElementById("f").appendChild(newDiv6);
  
flag=0;


}


document.getElementById("total").innerHTML="Total: "+total+"LE";
}


function confirm()
{
console.log("total===" +total);

for (i=0 ; i <arr.length ; i++)
{
 console.log(arr[i]);
 item[item.length]= document.getElementById(arr[i]).innerHTML;
}
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              if(total!=0)
{
              

                // document.getElementById("sucsess").innerHTML = "Your order has been updated successfully";

                alert("Your Order is Updated successfully");
                // document.getElementById("header3").innerHTML = xmlhttp.responseText;
}



for(i=0 ; i< arr.length ; i++)

{

element=document.getElementById(arr[i]);
element.remove();

l=document.getElementsByName(arr[i])[0].innerHTML;
l = l.split(":")[1]; 
total=total-l;
console.log("t= "+total);
document.getElementById("total").innerHTML="Total: "+total+"LE";

//console.log(total);
element = document.getElementsByName(arr[i])[0];
element.remove();
element = document.getElementById(arr[i]+'minus');
element.remove();
element = document.getElementById(arr[i]+'plus');
element.remove();
element = document.getElementById(arr[i]+'name');
element.remove();
element = document.getElementById(arr[i]+'close');
element.remove();

}

console.log("total after"+total);
for(i=0 ; i< arr.length ; i++)
{
arr.pop(); 
arr.splice(0,1);
console.log("array length"+arr.length);

}


}
}
             
         
         var selectCtrl = document.getElementById("combo");
         var selectCtrl2 = document.getElementById("notes");
         xmlhttp.open("GET", "home_data3.php?arr=" + arr + "&item=" + item+"&combo="+selectCtrl.value+"&notes="+selectCtrl2.value+"&total="+total+"&Date="+<?php echo "'$Date'"; ?>+"&orderId="+<?php echo $id; ?>, true);
         xmlhttp.send();
         console.log("done");
         window.location.replace("http://localhost/PHP-Project/docs/My_Orders.php");
}

</script>

</body>

</html>
