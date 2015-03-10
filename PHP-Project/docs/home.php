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
$t = ORM::getInstance();
$t->setTable('products');
$t->setTable('users');

?>


<div>
<textarea  class="form-control" id="notes" rows='4'  onfocus="if (this.innerHTML=='Write your notes here .. ') this.value = '';">Write your notes here .. </textarea>

<label> Room </label>
 <select  class="form-control" id="combo">
  <option value="<?php 

  $t = ORM::getInstance();
  $t->setTable('users'); 
  $result=$t->selectwhere("id",$_SESSION['id']);
 foreach($result as $key=>$value)
  {
    $room=$value['roomNum'];
    echo $room;
  }  ?>"> 


<?php $t = ORM::getInstance();
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
<br/> 

<h3><div id="total" class="label label-success" >TOTAL:</div></h3>

<br/> 


<input type='submit' value='confirm' class=" btn btn-info " onclick='confirm()'>
<br><br>


</div> 


<div id="sucsess" class="alert alert-success" role="alert"> 
</div>

</div> <!-- close of row-->

<!-- end of the lef form------------------------- -->

<div class="col-md-1" id="middle"> </div>

<div class="col-md-6" id="right">

<div id="header2">
<div id="header3">
<h3 class="page-header"> Last Order </h3>
<?php 
$t = ORM::getInstance();
 $t->setTable('orders');
$r=$t->getLast1($_SESSION['id']);

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
?>
<div style="float:left" style="width:120px;height:120px;margin-right:30px;">

<?php
foreach($r as $key=>$value)

{
 $img= $value['image'];
 $n= $value['name'];
?>
  <img src="../uploads/<?php echo $value['image'] ?>" class="img-rounded" height="100" width="100" >
   <h4 ><span class="label label-info text-center"><?php echo $n ."<br/>"; ?></span></h4>

<br/>
<?php
}
?>

</div>
<?php
}
}
echo "<br><br>";
?>


</div> <!-- last order div -->
<br/>
<br/>




<h3 class="page-header"> Menue </h3>
<?php

$t->setTable('products');
$result=$t->selectwhere('status',"'available'");
?>
<div style="float:left" style="width:100px;height:100px;margin-right:30px;" >
<table>
<tr>
<?php
foreach($result as $key=>$value)
{
  $i= $value['id'];
  $n= $value['price'];
  $name=$value['name'];

 

?>
<td class="text-center">
	<img src="../uploads/<?php echo $value['image'] ?>" class="img-rounded" height="100" width="100" id="<?php echo 'image'.$i?>" style="margin-left:20px" onclick="myFunction(<?php echo $i?>,<?php echo $n?>,<?php echo "'".$name."'"?>)">
<?php echo "<br/>" ;?>
  <h4 ><span id="<?php echo 'name'.$i?>" class="label label-info text center"><?php echo $name. "<br/>"; ?></span></h4>
  <span  id="<?php echo 'price'.$i?>" class="badge label label-warning"><?php echo $n."LE"; ?></span>
 </div>
</td> 
<?php
}
?>
<tr>
</table>

</div> 

</div> <!-- close of right row -->


<script> 
//start connection with socket on port 8080

var exampleSocket = new WebSocket("ws://127.0.0.1:8080");
//put the code you want to send to the server 
  
var fol;
var flag=1;
var id=0;
total=0;
var arr = [];
var name1="bj";
var item = new Array();
var count = new Array();


function myFunction(itemId,price,name)
{
    total=total+price;
    var flag=1;
    for (var i = 0; i < arr.length; i++)
    {

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

        var newDiv =  document.createElement("div"); 
        var newDiv2 = document.createElement("div"); 
        var newDiv4 = document.createElement("Button"); 
        var newDiv5 = document.createElement("Button"); 
        var newDiv6 = document.createElement("Button"); 


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

          }
       };

        newDiv6.onclick = function() { 

        // for(i=0 ; i< arr.length ; i++)

        // {
        //     if(arr[i]==itemId)
        //     {
        //        arr.splice(i,1); 
        //     }

        // }

        // element=document.getElementById(itemId);
        // element.remove();

       
        l = document.getElementById('cell3'+itemId).innerHTML;
       // console.log("lll"l);
        // l = l.split(":")[1]; 
        // l = l.split("LE")[0]; 
       
        total=total-l;
        document.getElementById("total").innerHTML="Total: "+total+"LE";
        document.getElementById("row"+itemId).remove();



        for(i=0 ; i< arr.length ; i++)
          {
              arr.pop(); 
              
          }
              arr.splice(0,1);
};


newDiv4.onclick = function() { 
  count[itemId]++; 
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
  
      flag=0;
}
    document.getElementById("total").innerHTML="Total: "+total+"LE";
}





var exampleSocket = new WebSocket("ws://127.0.0.1:8002");
   exampleSocket.onmessage = function (event) {
       console.log("fe el home user " + event.data);
       var msg = event.data;
       var res = msg.split(":");
       console.log(res[0]);
       console.log(res[1]);
       
       if (res[0] == "product") {
          if (res[2] == "unavailable") {
            document.getElementById("image"+res[1]).remove();
            document.getElementById("name"+res[1]).remove();
            document.getElementById("price"+res[1]).remove();
          }else{
            
            var img = document.createElement("img");
            img.setAttribute("src",'../uploads/'+res[5]);
            img.setAttribute("height","100px");
            img.setAttribute("width","100px");
            img.setAttribute("id","image"+res[1]);
            
            var spanName = document.createElement("span");
            spanName.setAttribute("class" ,"label label-info text center");
            var name = document.createTextNode(res[3]);
            spanName.appendChild(name);

            var br = document.createElement("br");
            var br1 = document.createElement("br");
            var br2 = document.createElement("br");


            var spanPrice = document.createElement("span");
            spanPrice.setAttribute("class" ,"badge label label-warning");
            var price = document.createTextNode(res[4] + " LE");
            spanPrice.appendChild(price);

            var h4 = document.createElement("h4");
             h4.appendChild(spanName); 
            var par = document.getElementById("header2");


            par.appendChild(img);
            par.appendChild(br1);
            par.appendChild(h4);
            
            par.appendChild(spanPrice);

            img.addEventListener("click" ,function(){
              myFunction(res[1],ParseInt(res[4]),res[3]);
            
          });
          
       }
     }
 
  }



function confirm()
{
   
    exampleSocket.send("Order");

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
              
                document.getElementById("sucsess").innerHTML = "Thank you";
                document.getElementById("header3").innerHTML = xmlhttp.responseText;
              }

          for(i=0 ; i< arr.length ; i++)

          {

             document.getElementById("row"+arr[i]).remove();

              l=document.getElementById("total").innerHTML;
              console.log(l);
              l = l.split(":")[1]; 
              l = l.split("LE")[0]; 
              total=total-l;
              document.getElementById("total").innerHTML="Total: "+total+"LE";

          }


          for(i=0 ; i< arr.length ; i++)
          {
              arr.pop(); 
              
          }
              arr.splice(0,1);

}
}

         var selectCtrl = document.getElementById("combo");
         var selectCtrl2 = document.getElementById("notes");
      
         selectCtrl2.value="write your notes here .. ";
                  
         xmlhttp.open("GET", "home_data2.php?arr=" + arr + "&item=" + item+"&combo="+selectCtrl.value+"&notes="+selectCtrl2.value+"&total="+total, true);
         xmlhttp.send();
         


}

</script>
</div> <!-- close of row div-->

</div> <!-- close of container -->
</body>

</html>
