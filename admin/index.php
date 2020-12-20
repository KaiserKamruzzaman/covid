<!DOCTYPE html>  
<html>  
 <head>  
  <title></title>
  <?php
   include'../assets/header.php';
   include "../controller/class.Crud.php";
   $object=new Crud();
   $result=$object->covidInfo();
   ?>
 </head> 

 <?php include'../assets/navbar.php' ?>

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

 <body>  
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" action="adminApi.php">
         <div align="center">  
          <label>Select CSV File:</label>
          <input type="file" name="file" />
          <br />
          <input type="submit" name="submit" value="Import" class="btn btn-info" />
         </div>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Cases - cumulative total</th>
                        <th>Cases - newly reported in last 24 hours</th>
                        <th>Deaths - cumulative total</th>
                        <th>Deaths - newly reported in last 24 hours</th>
                        <th>Transmission Classification</th>
                        <th>Action</th>
                    </tr>
        
                </thead>
                <tbody>
                   <?php

                   $total_case=0;
                   $total_death=0;
                   $new_toal_case=0;
                   $new_toal_death=0;
                   foreach ($result as $info)
                   {
                      $total_case+=$info['total_case'];
                      $total_death+=$info['total_death'];
                      $new_toal_case+=$info['new_case'];
                      $new_toal_death+=$info['new_death'];
                   }

                   $output='';
                   foreach ($result as $info) {
                      $output.=' 
                      <tr>
                         <td>'.$info['country'].'</td>
                         <td>'.$info['total_case'].'</td>
                         <td>'.$info['new_case'].'</td>
                         <td>'.$info['total_death'].'</td>
                         <td>'.$info['new_death'].'</td>
                         <td>'.$info['trans_type'].'</td>
                         <td class="btn btn-sm btn-warning" onclick=countryInfoEdit('.$info['id'].')>Edit</td>
                      </tr>';
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


  // edit specific country info
  function countryInfoEdit(id)
  {
    var countryInfoEdit=id;
    $.ajax({
      type:"POST",
      url:"adminApi.php",
      data:{countryInfoEdit:countryInfoEdit},
      success:function(data)
      {
        $('#country_modal').modal('show');
        $('#country_modal_content').html(data);

      }
    });
  }

  function countryInfoUpdate()
  {
    // alert('hello');
    $.ajax({
      type:"POST",
      url:"adminApi.php",
      data:$('#country_info_edit').serialize(),
      success:function(data)
      {
        alert('data');
        location.reload();
        // $('#country_modal').modal('hide');
      }
    });
  }




</script>
