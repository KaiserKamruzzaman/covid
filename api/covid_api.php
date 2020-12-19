<?php
	include "../controller/class.crud.php";
	$object=new Crud();

	if(isset($_POST["countryId"]))
	{
		$country_id=$_POST["countryId"];
		$result=$object->countryCovidInfo($country_id);
		$infected_data_per_day=array();
		$infected_date=array();
		foreach ($result as $res) {
			array_push($infected_data_per_day,$res['total_case']);
			$date=date_create($res['pub_date']);
			$date=date_format($date,"d M ");
			// $date="'".$res['pub_date']."'";
			array_push($infected_date,$date);
		}

		

		$output='
			<div class="modal-header">
			  <h5 class="modal-title">'.$result[0]['country'].' Covid Information</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
			  <canvas id="myChart" width="150" height="50"></canvas>
			</div>
		';

		echo json_encode(array($output,$infected_data_per_day,$infected_date));

	}


?>