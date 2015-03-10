<html>
<head>
<?php include_once ("AdminCss.php"); ?>
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
$t = ORM::getInstance();
$t->setTable('products');


echo " <br> <legend>Making order</legend>";
echo "<br> <br> " ;


$t->setTable('users');



?>


<div>
<textarea  class="form-control" id="notes" rows='4'  onfocus="if (this.innerHTML=='Write your notes here .. ') this.value = '';">Write your notes here .. </textarea>

<label> Room </label>
 <select  class="form-control" id="combo">

<?php
$t = ORM::getInstance();
$t->setTable("users");
$rooms = $t->selectdistinct('type',"'normal'");
foreach ($rooms as $key => $value) {

   ?>
  
  <option value= <?php echo $value['roomNum'];?>><?php echo $value['roomNum'];?></option>
<?php }?>
</select> 
<br/> 
--------------------------------------
<br>

<h3><div id="total" class="label label-success" >TOTAL:</div></h3>

<br/> 


<input type='submit' value='confirm' class=" btn btn-info " onclick='confirm()'>
<br><br>


</div> 


<div id="sucsess" class="alert alert-success" role="alert"> 
</div>


</div>
<div id="header2">
<div id="header3">

<br> <br>

User name : 

<select  id="combo1">
  <?php 

$t = ORM::getInstance();

$t->setTable('users');
$result=$t->selectwhere('type',"'normal'");
 
foreach($result as $key=>$value)
{

  echo "<option value=".$value['email'].">".$value['email']."</option>";

}


?>
</select> 

<br> <br>



</div>





<h3 class="page-header"> Menue </h3>

<?php
//include "db1.php";
$t->setTable('products');
$result=$t->selectAll();
?>  


<div style="float:left" style="width:100px;height:100px;margin-right:30px;" >
<table>
<tr>
<?php
foreach($result as $key=>$value)
{$i= $value['id'];
 $n= $value['price'];
$name=$value['name'];

 

?>
  <td class="text-center">
  <img src="../uploads/<?php echo $value['image'] ?>" class="img-rounded" height="100" width="100" style="margin-left:20px" onclick="myFunction(<?php echo $i?>,<?php echo $n?>,<?php echo "'".$name."'"?>)">
<?php echo "<br/>" ;?>
  <h4 ><span class="label label-info text center"><?php echo $name. "<br/>"; ?></span></h4>
  <span class="badge label label-warning"><?php echo $n."LE"; ?></span>
 </div>
</td> 
<?php
}
?>
<tr>
</table>


</div>

</div>

<script> 


var fol;

var flag=1;
var id=0;
total=0;
var item = new Array();

 var count = new Array();
var arr = [];
var name1="bj";


function text()
{


document.getElementById(notes).value="";
}


function myFunction(itemId,price,name)
{
total=total+price;


var flag=1;
for (var i = 0; i < arr.length; i++) {

    if(arr[i]==itemId)
{
flag=0;
count[itemId]++;
p=price*count[itemId];
 document.getElementById("cell2"+itemId).innerHTML=count[itemId];
          document.getElementById("cell3"+itemId).innerHTML=p;
}
  


}

if(flag==1)
{
arr[arr.length]=itemId;

var newDiv = document.createElement("div"); 
var newDiv2 = document.createElement("div"); 
var newDiv4 = document.createElement("Button"); 
var newDiv5 = document.createElement("Button"); 
var newDiv6 = document.createElement("Button"); 


//newDiv2.setAttribute('style', 'float:left');

//newDiv2.setAttribute('style', 'float:left');


        newDiv4.setAttribute('class','btn btn-success');
        newDiv4.setAttribute('class','glyphicon glyphicon-plus btn btn-success ');
        newDiv4.setAttribute('id',itemId+'plus');
        
        
        newDiv5.setAttribute('class','btn btn-warning');
        newDiv5.setAttribute('class','glyphicon glyphicon-minus btn btn-warning ');
        newDiv5.setAttribute('id',itemId+'minus');

        newDiv6.setAttribute('class','btn btn-danger');
        newDiv6.setAttribute('class','glyphicon glyphicon-remove btn btn-danger ');
        newDiv6.setAttribute('id',itemId+'close');
        
        newDiv.setAttribute('id',itemId+'name');
        

        newDiv2.setAttribute('name',itemId);

        var newDiv3 = document.createElement("div"); 
        newDiv3.setAttribute('id',itemId);


        count[itemId]=1;


newDiv5.onclick = function() { 
          if(count[itemId]>=2){
            count[itemId]--; 
            document.getElementById("cell2"+itemId).innerHTML=count[itemId];
            document.getElementById("cell3"+itemId).innerHTML=price*count[itemId];
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

       

       
        l = document.getElementById('cell3'+itemId).innerHTML;
        
       //  l = l.split(":")[1]; 
       // l = l.split("LE")[0]; 
       
        total=total-l;
        document.getElementById("total").innerHTML="Total: "+total+"LE";

        document.getElementById("row"+itemId).remove();

};


newDiv4.onclick = function() { count[itemId]++; 
  document.getElementById("cell2"+itemId).innerHTML=count[itemId];
  document.getElementById("cell3"+itemId).innerHTML=price*count[itemId];
  total= total+price;
  document.getElementById("total").innerHTML="Total: "+total+"LE";


};
  var newContent = document.createTextNode(name); 
  var newContent2 = document.createTextNode(price*count[itemId]); 
  var newContent3 = document.createTextNode(count[itemId]); 
  newDiv.appendChild(newContent);
  newDiv2.appendChild(newContent2);
  newDiv3.appendChild(newContent3);
   // newDiv4.appendChild(newContent4);

var v =1;
        var table = document.getElementById("f");
        var row = table.insertRow(v);
        row.setAttribute("id","row"+itemId);

        var cell1 = row.insertCell(0);
        cell1.appendChild(newContent);
         

        var cell2 = row.insertCell(1); //amount
        cell2.appendChild(newContent3);
        cell2.setAttribute("id","cell2"+itemId);
        

        var cell3 = row.insertCell(2);
        cell3.appendChild(newContent2); // price
        cell3.setAttribute("id","cell3"+itemId);

        var cell4 = row.insertCell(3);
        cell4.appendChild(newDiv4);

        var cell5 = row.insertCell(4);
        cell5.appendChild(newDiv5);

        var cell6 = row.insertCell(5);
        cell6.appendChild(newDiv6);
        v++;


     document.getElementById("f").appendChild(newDiv); //name
      document.getElementById("f").appendChild(newDiv3); //quantity
      document.getElementById("f").appendChild(newDiv2); //price
  
// for (i=0 ; i <arr.length ; i++)
// {
//      var item = document.getElementById(0);
//      console.log("item " + item);

// }
flag=0;


}


document.getElementById("total").innerHTML="Total: "+total+"LE";
}


function confirm()
{


for (i=0 ; i <arr.length ; i++)
{
 console.log(document.getElementById('cell2'+arr[i]).innerHTML);
        item[i]=document.getElementById('cell2'+arr[i]).innerHTML;
}
var xmlhttp = new XMLHttpRequest();
         xmlhttp.onreadystatechange = function() {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
              if(total!=0)
{
                 //  document.getElementById("sucsess").innerHTML = "Thank you";
                 // alert("Thank you ! your order will be delivered soon ");

           //     window.location.reload();

              document.getElementById("sucsess").innerHTML = "Thank you";


}



for(i=0 ; i< arr.length ; i++)

{
 document.getElementById("row"+arr[i]).remove();

              l=document.getElementById("total").innerHTML;
              l = l.split(":")[1]; 
              l = l.split("LE")[0]; 
              total=total-l;
              document.getElementById("total").innerHTML="Total: "+total+"LE";

}
for(i=0 ; i< arr.length ; i++)
{
arr.pop(); 
arr.splice(0,1);
console.log("array length"+arr.length);

}
}
}
             
         
         var selectCtrl = document.getElementById("combo");
                  var selectCtrl3 = document.getElementById("combo1");

var selectCtrl2 = document.getElementById("notes");
console.log(selectCtrl3.value);
         xmlhttp.open("GET", "home_data.php?arr=" + arr + "&item=" + item+"&combo="+selectCtrl.value+"&notes="+selectCtrl2.value+"&total="+total+"&userId="+selectCtrl3.value, true);
         xmlhttp.send();


}

</script>

</body>

</html>
