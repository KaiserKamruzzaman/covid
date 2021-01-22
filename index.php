<?php
	include "controller/class.Crud.php";
	$object=new Crud();
	$result=$object->covidInfo();
	// var_dump($result);


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- data-tablejs -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js
"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js
"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js
"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	<!-- chart js -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

</head>

<?php include'assets/navbar.php' ?>

<!-- modal start -->
<div class="modal" tabindex="-1" role="dialog" id="country_modal">
  <div class="modal-dialog modal-lg" role="document">
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
    <li class="nav-item">
      <a class="nav-link" href="login/index.php">Login</a>
    </li>
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
			                <th>Name</th>
			                <th>Cases - cumulative total</th>
			                <th>Cases - newly reported in last 24 hours</th>
			                <th>Deaths - cumulative total</th>
			                <th>Deaths - newly reported in last 24 hours</th>
			                <th>Transmission Classification</th>
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

			           $global_info=' 
			           		<tr>
			           			<td>Global</td>
			           			<td>'.$total_case.'</td>
			           			<td>'.$new_toal_case.'</td>
			           			<td>'.$total_death.'</td>
			           			<td>'.$new_toal_death.'</td>
			           			<td></td>
			           		</tr>
			            ';
			            echo $global_info;
			           $output='';
			           foreach ($result as $info) {
			           		$output.=' 
		           			<tr>
		           		     <td onclick="countryInfo('.$info['id'].')">'.$info['country'].'</td>
		           		     <td>'.$info['total_case'].'</td>
		           		     <td>'.$info['new_case'].'</td>
		           		     <td>'.$info['total_death'].'</td>
		           		     <td>'.$info['new_death'].'</td>
		           		     <td>'.$info['trans_type'].'</td>
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


	function countryInfo(id)
	{
		countryId=id;
		$.ajax({
		  type:"POST",
		  url:"api/covid_api.php",
		  data:{countryId:countryId},
		  dataType: "json",
		  success:function(data)
		  {
		  	
		  	$('#country_modal').modal('show');
		  	$('#country_modal_content').html(data[0]);
		  	covidChart(data[1],data[2]);

		  }
		});

	}

	function covidChart(country_data,date)
	{
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'bar',
		    data: {
		        labels: date,
		        datasets: [{
		            label: 'Number of Infections',
		            data: country_data,
		            backgroundColor: [
		                'rgba(255, 99, 132, 0.2)',
		                'rgba(54, 162, 235, 0.2)',
		                'rgba(255, 206, 86, 0.2)',
		                'rgba(75, 192, 192, 0.2)',
		                'rgba(153, 102, 255, 0.2)',
		                'rgba(255, 159, 64, 0.2)'
		            ],
		            borderColor: [
		                'rgba(255, 99, 132, 1)',
		                'rgba(54, 162, 235, 1)',
		                'rgba(255, 206, 86, 1)',
		                'rgba(75, 192, 192, 1)',
		                'rgba(153, 102, 255, 1)',
		                'rgba(255, 159, 64, 1)'
		            ],
		            borderWidth:1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: true
		                }
		            }]
		        }
		    }
		});
	}

</script>

