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
        <a class="nav-link" href="index.php">Dashboard</a>
      </li>
     <li class="nav-item">
       <a class="nav-link" href="business_org.php">Medical Org</a>
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
    <!-- csv upload section -->
<!--     <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            Upload CSV File..
          </div>
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="adminApi.php">
             <div align="center">
              <div class="form-group">
                  <input type="text" class="form-control text-center" name="csv_date"
                   value="<?php $date = new DateTime('now', new DateTimezone('Asia/Dhaka')); 
                   echo $date->format('Y-m-d'); ?>"  readonly>
              </div>  
              <label>Select CSV File:</label>
              <input type="file" name="file" />
              <br />
              <input type="submit"  name="submit" value="Import" class="btn btn-success" />
             </div>
            </form>
          </div>
        </div>
        <br><br>
      </div>
      <div class="col-md-3"></div>
    </div> -->

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            Upload CSV File..
          </div>
          <div class="card-body">
            <form id="csv_upload_form">
             <div align="center">
              <div class="form-group">
                  <input type="text" id="csv_date" class="form-control text-center" name="csv_date"
                   value="<?php $date = new DateTime('now', new DateTimezone('Asia/Dhaka')); 
                   echo $date->format('Y-m-d'); ?>"  readonly>
              </div>  
              <label>Select CSV File:</label>
              <input type="file" id="csv_file" name="file" />
              <br />
              <input type="submit"  name="submit" value="Import" class="btn btn-success"/>
             </div>
            </form>
          </div>
        </div>
        <br><br>
      </div>
      <div class="col-md-3"></div>
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
        alert('Data Updated Successfully!!!');
        location.reload();
        // $('#country_modal').modal('hide');
      }
    });
  }

  // csv_file upload section

  // function upload_csv()
  // {
  //   var csv_date=$('#csv_date').val();
  //   var csv_file_path=$('#csv_file').val();
  //   var csv_file_name=$('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
  //   var csv_file_name = csv_file_name.split(".");
  
  //   var form_data = new FormData($('#csv_upload_form').val());                  




  //   if(csv_file_name[1]!='csv')
  //   {
  //     alert("Please Upload a CSV file..");
  //   }
  //   else{
  //     $.ajax({
  //       type:"POST",
  //       url:"adminApi.php",
  //       data:$('#csv_upload_form').serialize(),
  //       success:function(data)
  //       {
                    
  //       }
  //     });
  //   }
  // }

  //csv_file upload section........
  $('#csv_upload_form').on('submit',function(e){

    e.preventDefault();
    var form_data = new FormData(this);
    var csv_file_name=$('input[type=file]').val().replace(/C:\\fakepath\\/i, '');
    var csv_file_name = csv_file_name.split(".");

    if(csv_file_name[1]!='csv')
    {
      alert("Please Upload a CSV file..");
    }
    else{

      $.ajax({
        type:"POST",
        url:"adminApi.php",
        data:form_data,
        contentType: false,
        processData: false,
        success:function(data)
        {
          if(data=='1')
          {
            alert('Date already Exists...');
          }
          else
          {
            alert('File uploaded successfully...');
            location.reload();
          }
        }
      });

    }

  });



</script>
