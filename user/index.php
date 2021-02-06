<!DOCTYPE html>  
<html>  
 <head>  
  <title></title>
  <?php
   session_start();
   if(!isset($_SESSION["user_name"]))
   {
     header("Location: ../login/index.php");
   }
   include'../assets/header.php';
   include "../controller/class.Crud.php";
   $object=new Crud();
   $user_id=$_SESSION["user_id"];

   $user_info=$object->user_profile($user_id);
   // var_dump($user_info);
   ?>
 </head> 



 <!-- modal start -->
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
      <!-- <form></form> -->
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">User Info Edit</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form method="post" action="user_api.php">
         <div class="modal-body">
            <!-- user edit form -->
             <?php
              echo'
                <input type="hidden" name="user_id" value='.$user_info['id'].'>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value="'.$user_info['name'].'" name="name" required>
                </div>
                <div class="form-group">
                  <label>E-mail</label>
                  <input type="email" class="form-control" value='.$user_info['email'].' name="email" required>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="text" class="form-control" value='.$user_info['password'].' name="password" required>
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <input type="text" class="form-control" value='.$user_info['country'].' name="country" required>
                </div> 
              ';
             ?>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Update</button>
         </div>
       </form>
     </div>
   </div>
 </div>
 <!-- modal end -->

 <!-- nabvar portion -->
 <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
   <a class="navbar-brand" href="../index.php">Logo</a>
   <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Home</a>
      </li>

   </ul>

   <ul class="navbar-nav ml-auto">
      
    <?php
      if(isset($_SESSION["user_name"]))
      {
        echo '
           <span class="navbar-text mr-4">
             <a href="../user/index.php">Welcome, '.$_SESSION["user_name"].'</a>
             
           </span>
        ';
      }
      if(!isset($_SESSION["user_name"]))
      {
        echo '
          <li class="nav-item">
            <a class="nav-link" href="login/index.php">Login</a>
          </li>
         ';
      }
      else{
        echo ' 
          <li class="nav-item">
            <a class="nav-link" href="../login/logout.php">Logout</a>
          </li>
         ';
      }
    ?>

   </ul>
 </nav>
 <br><br><br>
 <!-- nabvar portion end -->

 <body>  
  <div class="container">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-5">

        <div class="card">
          <div class="card-header text-center">User Profile</div>
          <div class="card-body">
            <table class="table ">
              <tbody>
               <?php

                echo ' 
                  <tr>
                    <td class="text-primary">Name</td>
                    <td class="text-success">'.$user_info['name'].'</td>
                  </tr>
                  <tr>
                    <td class="text-primary">Email</td>
                    <td class="text-success">'.$user_info['email'].'</td>
                  </tr>
                  <tr>
                    <td class="text-primary">Password</td>
                    <td class="text-success">'.$user_info['password'].'</td>
                  </tr>
                  <tr>
                    <td class="text-primary">Country</td>
                    <td class="text-success">'.$user_info['country'].'</td>
                  </tr>
                ';
               ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Edit</button>
          </div>
        </div>

      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Picture</div>
          <div class="card-body">
            <?php

            ?>
            <img src="<?php echo '../uploads/images/'.$user_info['image']; ?>" width="300px" height="257px" >
          </div>
        </div>
      </div>
    </div>
  </div>

 </body>  
</html>


<script type="text/javascript">

</script>
