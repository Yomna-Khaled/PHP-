<?php
require 'appconf.php';

class ORM {

    static $conn;
    private $dbconn;
    protected $table;
    protected $table1;

    static function getInstance(){
        if(self::$conn == null){
            self::$conn = new ORM();
        }
        return self::$conn;
    }
    
    protected function __construct(){    
        extract($GLOBALS['conf']);
        $this->dbconn = new mysqli($host, $username, $password, $database);
    }
    
    
    function getLast1($id){

        $query = "select id from orders where userId=".$id." "."ORDER BY id DESC LIMIT 1;";
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;

}


    
    function getConnection(){
        return $this->dbconn;
    }
    
    function setTable($table){
        $this->table = $table;
    }

    function setTable1($table12){
        $this->table1 = $table12;
    }

     function insert($data){
        $query = "insert into $this->table set ";
        foreach ($data as $col => $value) {
            $query .= $col."= '".$value."', ";   
        }
        $query[strlen($query)-2]=" ";


        //echo "g ====> ".$query;
        $state = $this->dbconn->query($query);
        if(! $state){
            return $this->dbconn->error;
        }
        
        return $this->dbconn->affected_rows;   
    }
    
    function selectAll(){
      $users = array();
    	$query = "select * from $this->table";
    	$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
        	$row = mysqli_fetch_assoc($result);
		//$user = array_values($row);
		$users[]=$row; 
        } 

        if ($users == NULL) {
            return "fadyyyy";
        }else {
          return $users;
        }
        
    
    }

 function selectdistinct($key,$id){
  $users = array();
        $query = "select distinct roomNum from $this->table where $key=";
                $query .= $id.';';

        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 

        if ($users == NULL) {
            return "fadyyyy";
        }else {
          return $users;
        }
        
    
    }

    function selectwhere($key,$id){
      $users = array();
    	$query = "select * from $this->table where $key=";
        $query .= $id.';';

       //echo "dhsfkh"." ".$query;
    	$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
        	$row = mysqli_fetch_assoc($result);
		
		$users[]=$row; 
        } 
        return $users;
    
    }



       function joinDate($pk , $fk , $from , $to){
        $users = array();
        $query = "select * from $this->table1 , $this->table where $this->table.$pk = $this->table1.$fk and date between '$from' and '$to' ;"; 
        //echo "query : ".$query;
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        $users[]=$row; 
        } 
        return $users;       

     }


function selectDate($col , $value , $from , $to ){
  $users = array();
        $query = "select * from $this->table  where $col = $value and date between '$from' and '$to' ;"; 
        //echo "query : ".$query;
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        $users[]=$row; 
        } 
        return $users;       

     }
    


   function delete($key ,$id){
        $query = "delete from $this->table where $key=";
       
            $query .=$id.';';   
       
        $state = $this->dbconn->query($query);
       
        return $state;   
    }



     function update($data,$id)
     {
         $query = "update $this->table set ";
         foreach ($data as $col => $value) {
             $query .= $col."= '".$value."', ";
         }
          $query[strlen($query)-2]=" ";
          $query.='where id='.$id.';';

          
          $state = $this->dbconn->query($query);
          if(! $state){ 
            return $this->dbconn->error;
         }
        return $query;
     }

     function join($table1,$table2 , $pk , $fk){
      $users = array();
        $query = "select * from $this->table1 , $this->table where $this->table.$pk = $this->table1.$fk "; 
    
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        $users[]=$row; 
        } 
        return $users;       

     }
     function yy(){
        $users = array();
        $query = "select * from products , (select * from order_item , (select users.id as USERID , room , username , orders.id as OID , date , status , total  from users ,
     orders where users.id = orders.userId) as t where order_item.orderId = t.OID) as y where products.id = y.itemId order by  orderId;";
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
            $users[]=$row; 
        } 
        var_dump($users);

        return $users;       
     

     }

     function joinDateGroupBy($table1,$table2 , $pk , $fk,$GrpBy , $from , $to){
       $users = array();
        $query = "select *,sum(total) from $this->table1 , $this->table where $this->table.$pk = $this->table1.$fk  and date between '$from' and '$to' group by $GrpBy;"; 
        
      
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
            $users[]=$row; 
        } 
        //var_dump($users);
        return $users;       
     }







     // function joinGroupBy($table1,$table2 , $pk , $fk,$GrpBy , $from , $to){
     //    $query = "select *,sum(total) from $this->table1 , $this->table where $this->table.$pk = $this->table1.$fk group by $GrpBy;"; 
        
      
     //     $result = mysqli_query($this->dbconn,$query); 
     //       if(! $result){
     //         return $this->dbconn->error;
     //    }

     //    for($i=0; $i < $this->dbconn->affected_rows ; $i++){
     //        $row = mysqli_fetch_assoc($result);
     //    $users[]=$row; 
     //    } 
     //    return $users;       

     // }










     function joinwhere($table1,$table2 , $pk , $fk , $value){
        echo "string"."<br/>";
        $query = "select * from $this->table1 , $this->table where $this->table.$pk = $this->table1.$fk and $this->table.$pk=$value"; 
        echo "sdsd".$query;
         $result = mysqli_query($this->dbconn,$query); 
           if(! $result){
             return $this->dbconn->error;
        }

        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        $users[]=$row; 
        } 
        return $query;       


     }



    function getId($name)

    {
      $users = array();
$query = "select * from users where email="."'$name'".";";
echo $query;
        $result = mysqli_query($this->dbconn,$query);
for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;
    }


    function getlast(){
        $users = array();
        $query = "select id from orders ORDER BY id DESC LIMIT 1;";
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;

}



function selectspecial($id){
  $users = array();
        $query = "select * from $this->table where orderId=";
        $query .= $id.';';
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        //$user = array_values($row);
        $users[]=$row; 
        } 
        return $users;
    
    }




  function selectorders($value){
    $users = array();
        $query = "select id,date,status,total from $this->table where userId=$value order by date desc limit 5;";
      
        $result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
    
        $users[]=$row; 
        } 
        return $users;
    
    }


 function selectdates($from,$to,$value){
  $users = array();
$query="select id,date,status,total from $this->table WHERE userId=$value and DATE(date) BETWEEN "." '".$from."'"."AND"."'".$to."' ".";";




$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        
        $users[]=$row; 
        } 
        return $users;
    
    }


 function selectsumdate($from,$to,$value){
$query="SELECT  SUM(total) total FROM $this->table WHERE userId=$value and date BETWEEN "."'".$from."'"." AND"." '".$to." ';";

$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        
        $sum[]=$row; 
        } 
        return $sum;
    
    }
   
 function selectsumorders($value){
$query="select sum(total) from (select id,date,status,total from orders where userId=$value order by date desc limit 5) as subt;";

$result = mysqli_query($this->dbconn,$query);
        if(! $result){
            return $this->dbconn->error;
        }
        
        for($i=0; $i < $this->dbconn->affected_rows ; $i++){
            $row = mysqli_fetch_assoc($result);
        
        $sum[]=$row; 
        } 
        return $sum;
    
    }
   
     
 }


