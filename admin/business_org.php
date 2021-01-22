<!DOCTYPE html>
<html>
<head>
	<title>Business Org</title>
	<?php
		 include'../assets/header.php';
		 include "../controller/class.Crud.php";
		 $object=new Crud();
		 $result=$object->covidInfo();
	 ?>
</head>

<!-- modal start -->
<div class="modal" tabindex="-1" role="dialog" id="country_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content" id="country_modal_content">
    <!--   <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div> -->
    </div>
  </div>
</div>
<!-- modal end -->

<!-- nabvar portion -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand" href="../index.php">Logo</a>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="business_org.php">Business Org</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../login/index.php">Login</a>
    </li>
  </ul>
</nav>
<br><br><br>
<!-- nabvar portion end -->

<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Hello from Business Organization.....</h1>
				<button class="btn btn-success" id="add_org">Add Organization</button>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('#add_org').click(function(){
		alert('hello');
	});
</script>