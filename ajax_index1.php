<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->
  
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    
<div class="container">
<h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATIONS</h1>

<div class="d-flex justify-content-end">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
Add User
</button>
</div>

<h2 class="text-primary">All Records</h2>

<div id="records_contant">
</div>



<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Data Entry</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div> 

      <!-- Modal body -->
       <div class="modal-body">
        <div class="form-group">
            <label>First name:</label>
            <input type="text" name="" id="firstname" class="form-control" placeholder="First Name">
        </div>

        <div class="form-group">
            <label>Last Name :</label>
            <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name">
        </div>

        <div class="form-group">
            <label>Email id : </label>
            <input type="email" name="" id="email" class="form-control" placeholder="Email">
        </div>
        
        <div class="form-group">
            <label>Mobile :</label>
            <input type="phone" name="" id="mobile" class="form-control" placeholder="Mobile Number">
        </div>


      </div>

      <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button"  id="btn"  class="btn btn-success" data-dismiss="modal" onclick="addRecord()" >Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
      </div>

    </div>
  </div>
</div>

<!-- update model -->
<div class="modal" id="updateModal">
  <div class="modal-dialog">
    <div class="modal-content">

      
      <div class="modal-header">
        <h4 class="modal-title">Update Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div> 

      <!-- Modal body -->
       <div class="modal-body">
        <div class="form-group">
            <label for="update_firstname"> First name:</label>
            <input type="text" name="" id="update_firstname" class="form-control" placeholder="First Name">
        </div>

        <div class="form-group">
            <label>Last Name :</label>
            <input type="text" name="" id="update_lastname" class="form-control" placeholder="Last Name">
        </div>

        <div class="form-group">
            <label>Email id : </label>
            <input type="email" name="" id="update_email" class="form-control" placeholder="Email">
        </div>
        
        <div class="form-group">
            <label>Mobile :</label>
            <input type="phone" name="" id="update_mobile" class="form-control" placeholder="Mobile Number">
        </div>


      </div>

      <!-- Modal footer -->
       <div class="modal-footer">
        <button type="button"  id="btn"  class="btn btn-success" data-dismiss="modal" onclick="UpdateRecord()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
       <input type="hidden" name="" id="hidden_id">
      </div>

    </div>
  </div>
</div>




</div> 

<!-- 
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script> -->


<script type="text/javascript" >

  $(document).ready(function(){
  readRecords();
   });

   function readRecords(){
    var readrecord="readrecord";
    $.ajax({
      url:"ajax_backend1.php",
      type:"POST",
     data:{readrecord:readrecord},
     success:function(data,status){
      $('#records_contant').html(data)
     }
    });

   }




    function addRecord(){

        var firstname=$('#firstname').val();
        var lastname=$('#lastname').val();
        var mobile=$('#mobile').val();
        var email=$('#email').val();

      $.ajax({
        url:"ajax_backend1.php",
        type:"POST",
        data:{
            firstname : firstname,
            lastname : lastname,
            mobile : mobile,
            email : email
        },
    
        success:function(data,status)
        {
            readRecords();
        }
        
      }); 

    }

    //delete record call
    function DeleteUser(uid){
    var conf=confirm("Are You Sure?");
      // alert(id);
       if(conf==true)
       {
      // alert(id);
         $.ajax({
        url:"ajax_backend1.php", 
        type:"POST",
        data:{uid : uid },
    
        success:function(data,status)
        {
            readRecords();
           // alert("hello");
        }
        });
        
      }
    }



    function GetUserDetails(updateid)
    {
      $('#hidden_id').val(updateid);
      
     $.post("ajax_backend1.php",{updateid:updateid},function(data,status){
     var user=JSON.parse(data);
    // console.log(data);
    //   //javascript object notation
      $('#update_firstname').val(user.firstname);
      $('#update_lastname').val(user.lastname);
      $('#update_email').val(user.email);
      $('#update_mobile').val(user.mobile);
    
      }
      );

     $('#updateModal').modal("show");
    }

  function UpdateRecord(){
    var update_firstname=$('#update_firstname').val();
    var update_lastname=$('#update_lastname').val();
    var update_email=$('#update_email').val();
    var update_mobile=$('#update_mobile').val();
     var hidden_id=$('#hidden_id').val();
    
    $.post("ajax_backend1.php",{
         hidden_id : hidden_id,
          update_firstname : update_firstname,
          update_lastname: update_lastname,
          update_email : update_email,
          update_mobile: update_mobile
        },function(data,status){
    //       //$('#updateModal').modal("hide");
    //alert(data);
       readRecords();        
      }); 

  } 

  </script>
</body>
</html> 

 

