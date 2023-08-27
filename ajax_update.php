<?php

$conn=mysqli_connect("localhost","root","","crud");

if(isset($_POST['updateid']))
{
 $user_id=$_POST['updateid'];
 $query="SELECT FROM crud WHERE `crud`.`id` = $user_id";
 $result=mysqli_query($conn,$query);
 $response=array();
   while($row=mysqli_fetch_assoc($result)){
     $response=$row;
   }
  echo json_encode($response);
 }
else{
 $response['status']=200;
 $response['message']="Invalid Request!";
}

?>