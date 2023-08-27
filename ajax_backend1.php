<?php



// if($_SERVER['REQUEST_METHOD']=='POST')
// {
// $firstname=$_POST['firstname'];
// $lastname=$_POST['lastname'];
// $email=$_POST['email'];
// $mobile=$_POST['mobile'];

// $conn=mysqli_connect("localhost","root","","crud");
// $sql="INSERT INTO `crud` ( `firstname`, `lastname`, `email`, `mobile`)  VALUES ( '$firstname', '$lastname', '$email', '$mobile')";
// mysqli_query($conn,$sql);

// if(mysqli_affected_rows($conn)> 0)
// {
//   echo "saved";
// }else{
//   echo "error";
// }
// }

$conn=mysqli_connect("localhost","root","","crud");
extract($_POST);
if(isset($_POST['readrecord'])){
  $data='<table class="table table-bordere d table-striped">
  <tr>
     <th>No.</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>Email </th>
     <th>Mobile Number</th>
     <th>Edit Action</th>
     <th>Delete Action</th>
  </tr>';
 $displayquery="SELECT *FROM crud";
 $result=mysqli_query($conn,$displayquery);

if(mysqli_num_rows($result)>0){
$number=1;

while($row=mysqli_fetch_array($result)){

  $data.='<tr>
  

  <td>'.$number.'</td>
  <td>'.$row['firstname'].'</td>
  <td>'.$row['lastname'].'</td>
  <td>'.$row['email'].'</td>
  <td>'.$row['mobile'].'</td>
  
  <td>
  <button onclick="GetUserDetails('.$row['id'].')"
   class="btn btn-warning"> Edit </button>
  </td>
  
  <td>
  <button onclick="DeleteUser('.$row['id'].')"
   class="btn btn-danger"> Delete </button>
  </td>

  </tr>';
  $number++;

}

}
$data.='</table>';
echo $data;
}



if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile']) )
{
  $sql="INSERT INTO `crud` ( `firstname`, `lastname`, `email`, `mobile`)  VALUES ( '$firstname', '$lastname', '$email', '$mobile')";
   mysqli_query($conn,$sql);
  
}


//delete user reccord

 if(isset($_POST['uid']))
 {
 $userid=$_POST['uid'];
  
  $deletequery="DELETE FROM crud WHERE `crud`.`id` = $userid";
  mysqli_query($conn,$deletequery);
 }

 //update record

 if(isset($_POST['updateid']))
  {
  $user_id=$_POST['updateid'];
  $query="SELECT *FROM crud WHERE id = $user_id";
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

//update query


if(isset($_POST['hidden_id']) )
{
$id=$_POST['hidden_id'];
$firstname=$_POST['update_firstname'];
$lastname=$_POST['update_lastname'];
$email=$_POST['update_email'];
$mobile=$_POST['update_mobile'];

$sql="UPDATE `crud` SET `firstname`='$firstname' , `lastname` = '$lastname', `email` = '$email', `mobile` = '$mobile' WHERE `crud`.`id` = $id";
$result=mysqli_query($conn,$sql);

if(mysqli_affected_rows($conn)> 0)
{
  echo "saved";
}else{
  echo "error";
}
}
?>