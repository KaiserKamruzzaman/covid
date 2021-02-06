<!DOCTYPE html>  
<html>  
 <head>  
  <title></title>
  <?php
    session_start();
     include'assets/header.php';
     include "controller/class.Crud.php";
     $object=new Crud();
     $result=$object->show_organizations();
     // var_dump($result);
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
   <a class="navbar-brand" href="index.php">Logo</a>
   <ul class="navbar-nav">
      <?php
        if(isset($_SESSION["user_name"]) && $_SESSION["user_type"]==1)
        {
          echo' 
            <li class="nav-item">
              <a class="nav-link" href="admin/index.php">Dashboard</a>
            </li>
           ';
        }

      ?>
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
             <a href="user/index.php">Welcome, '.$_SESSION["user_name"].'</a>
             
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
            <a class="nav-link" href="login/logout.php">Logout</a>
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

        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Org Name</th>
              <th>Location</th>
              <th>Rating</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $output='';
              foreach ($result as $res) {
                $avg_rating=$object->avg_rating($res['id']);
                // var_dump($avg_rating['avg_rating']);
                // echo $avg_rating;
                $output.=' 
                  <tr>
                    <td>'.$res['name'].'</td>
                    <td>'.$res["location"].'</td>
                    <td>'.$avg_rating['avg_rating'].'</td>
                    <td><a href="view_org.php?id='.$res['id'].'" class="btn btn-sm btn-primary">View</a></td>
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



</script>


