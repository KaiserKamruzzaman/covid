<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<!-- nabvar portion -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="../index.php">Logo</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Login</a>
    </li>
  </ul>
</nav>
<br><br><br>
<!-- nabvar portion end -->

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center text-success">Register YourSelf Here!!</div>
          <div class="card-body">
            
            <form method="post" action="signup_api.php">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="user_name" placeholder="Enter Name" required>
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input type="email" class="form-control" name="user_email" aria-describedby="emailHelp" placeholder="Enter email" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="user_pass" placeholder="Enter Password" required>
              </div>
              <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control" name="user_country" placeholder="Enter Country" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>

          </div>
        </div>
      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
</body>
</html>

<!-- login portion -->
<script type="text/javascript">


</script>
<!-- login portion end -->



