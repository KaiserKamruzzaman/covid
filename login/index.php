<?php
  session_start();


?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<!-- nabvar portion -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="../index.php">Logo</a>

  <ul class="navbar-nav ml-auto">
     
   <?php
     if(isset($_SESSION["user_name"]))
     {
       echo '
          <span class="navbar-text mr-4">
            Welcome, '.$_SESSION["user_name"].'
          </span>
       ';
     }
     if(!isset($_SESSION["user_name"]))
     {
       echo '
         <li class="nav-item">
           <a class="nav-link" href="index.php">Login</a>
         </li>
        ';
     }
     else{
       echo ' 
         <li class="nav-item">
           <a class="nav-link" href="logout.php">Logout</a>
         </li>
        ';
     }
   ?>

  </ul>
</nav>
<br><br><br>
<!-- nabvar portion end -->

<body>
  <div class="wrapper fadeInDown">
  <div id="formContent">

    <form>
      <br>
      <br>
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="Enter Your Email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Enter Your Password">
      <input type="button" id="signIn" class="fadeIn fourth" value="Log In" style="margin-bottom: 1rem;">

      <div class="alert alert-danger" role="alert" id="login_error" style="display: none;">
        
      </div>
      <div>
        <span>Not Registered?? <a href="signup.php">Sign Up</a> Now!!!</span>
      </div>
     
    </form>

  </div>
</div>
</body>
</html>

<!-- login portion -->
<script type="text/javascript">

  $('#signIn').click(function(){
    var email=$('#email').val();
    var password=$('#password').val();

    $.ajax({
      type:"POST",
      url:"loginApi.php",
      data:{email:email,password:password},
      success:function(data)
      {
        if(data=='1')
        {
          window.location.href="../admin/index.php";
        }
        else if(data=='2')
        {
          window.location.href="../user/index.php";
        }
        else{
          $('#login_error').show();
          $('#login_error').html('Invalid UserName or Password');
        }
      }
    });

  });

</script>
<!-- login portion end -->



