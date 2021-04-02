<!DOCTYPE html>
<html>
<head>
	<title>Business Org</title>
	<?php
     session_start();
     if(!isset($_SESSION["user_name"]))
     {
       header("Location: ../login/index.php");
     }
     if(isset($_SESSION["user_name"]))
     {
       if($_SESSION["user_type"]==2)
       {
        header("Location: ../login/logout.php");
       }
       
     }
		 include'../assets/header.php';
		 include "../controller/class.Crud.php";
		 $object=new Crud();
		 $result=$object->show_organizations();
	 ?>
</head>

<!-- modal start -->
<div class="modal" tabindex="-1" role="dialog" id="admin_modal">
  <div class="modal-dialog " role="document">
    <div class="modal-content" id="admin_modal_content">
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
      <a class="nav-link" href="../index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index.php">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="business_org.php">Medical Org</a>
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
           <a class="nav-link" href="../login/index.php">Login</a>
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
			<div class="col-md-12">
        <div class="d-flex justify-content-end">
          <button class="btn btn-success" id="add_org">Add Medical Org</button>
        </div>
        <hr>
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Organization Name</th>
              <th>Organization Location</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $output='';
              foreach ($result as $org) 
              {
                $output.='
                  <tr>
                    <td>'.$org['name'].'</td>
                    <td>'.$org['location'].'</td>
                    <td class="btn btn-sm btn-warning" onclick=org_edit('.$org['id'].')>Edit</td>
                    <td class="btn btn-sm btn-danger ml-4" onclick=org_delete('.$org['id'].')>Delete</td>
                  </tr>
                ';
              }

              echo $output;

            ?>
          </tbody>
        </table>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">

  $(document).ready(function() {
      $('#example').DataTable( {
          dom: 'lBfrtip',
          buttons: [
              'copy', 'csv', 'excel', 'pdf', 'print'
          ]
      } );
  } );

	$('#add_org').click(function(){
    var org_add_modal='org_add_modal';
		$.ajax({
      type:"POST",
      url:"adminApi.php",
      data:{org_add_modal:org_add_modal},
      success:function(data)
      {
        $('#admin_modal').modal('show');
        $('#admin_modal_content').html(data);

      }
    });
	});

  function add_org()
  {
    $.ajax({
      type:"POST",
      url:"adminApi.php",
      data:$('#org_add_form').serialize(),
      success:function(data)
      {
        alert("Data inserted successfully...");
        location.reload();
      }
    });
  }

  function org_edit(id)
  {
    var org_id=id;
    $.ajax({
      type:"POST",
      url:"adminApi.php",
      data:{org_id:org_id},
      success:function(data)
      {
        $('#admin_modal').modal('show');
        $('#admin_modal_content').html(data);
      }
    });

  }


  function org_update(id)
  {
    var org_id=id;
    $.ajax({
      type:"POST",
      url:"adminApi.php",
      data:$('#org_info_edited').serialize()+"&org_id="+org_id,
      success:function(data)
      {
        alert("Data Updated successfully...");
        location.reload();
      }
    });
  }

  function org_delete(org_id)
  {
    var org_id_delete=org_id;
    var check = confirm("Are you sure!!!!");
    if (check)
    {

      $.ajax({
        type:"POST",
        url:"adminApi.php",
        data:{org_id_delete:org_id_delete},
        success:function(data)
        {
          alert("Data deleted successfully...");
          location.reload();
        }
      });

    }
    
  }

</script>

