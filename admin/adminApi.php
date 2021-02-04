<?php
	include "../controller/class.Crud.php";
	$object=new Crud();


	if(isset($_POST["submit"]))
	{
	 if($_FILES['file']['name'])
	 {

	 	$date=$_POST['csv_date'];
	  	$filename = explode(".", $_FILES['file']['name']);
	  // var_dump($filename);
	  if($filename[1] == 'csv')
	  {

	   $handle = fopen($_FILES['file']['tmp_name'], "r");
	   $i=0;
	   while($data_tmp = fgetcsv($handle,1000))
	   {
	   		$data[]=$data_tmp;
	   		// $object->uploadCsv($data);

	   }
	   fclose($handle);
	   //array_shift($data);
	   foreach($data as $d){
	   		$object->uploadCsv($d,$date);
	   }
	   header("Location: index.php"); 
	   // echo "<script>alert('CSV file upload done...');</script>";
	   exit();
	  }
	  else{
	  	header("Location: index.php");
	  }
	 }
	}


	if(isset($_POST["countryInfoEdit"]))
	{
		$country_id=$_POST["countryInfoEdit"];
		$result=$object->countryInfo($country_id);
		$output='
			<div class="modal-header">
	         <h5 class="modal-title">'.$result['country'].' Covid Info</h5>
	         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	           <span aria-hidden="true">&times;</span>
	         </button>
	       </div>
	       <form id="country_info_edit">
	       		<input type="hidden" name="country_id" value='.$result['id'].'>
		       	<div class="modal-body">
		       	  <div class="form-group">
		       	    <label>Country</label>
		       	    <input type="text" class="form-control" value='.$result['country'].' readonly>
		       	  </div>
		       	  <div class="form-group">
		       	    <label>Cases - cumulative total</label>
		       	    <input type="text" class="form-control" name="total_case_update" value='.$result['total_case'].'>
		       	  </div>
		       	  <div class="form-group">
		       	    <label>Cases - newly reported in last 24 hours</label>
		       	    <input type="text" class="form-control" name="new_case_update" value='.$result['new_case'].'>
		       	  </div>
		       	  <div class="form-group">
		       	    <label>Deaths - cumulative total</label>
		       	    <input type="text" class="form-control" name="total_death_update" value='.$result['total_death'].'>
		       	  </div>
		       	  <div class="form-group">
		       	    <label>Deaths - newly reported in last 24 hours</label>
		       	    <input type="text" class="form-control" name="new_death_update" value='.$result['new_death'].'>
		       	  </div>
		       	</div>
		       	<div class="modal-footer">
		       	  <button type="button" class="btn btn-primary"  onclick="countryInfoUpdate()">Save changes</button>
		       	  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		       	</div>
	       </form>
	     
		';

		echo $output;
		

	}

	if(isset($_POST['total_case_update']))
	{
		$id=$_POST['country_id'];
		$total_case=$_POST['total_case_update'];
		$new_case=$_POST['new_case_update'];
		$total_death=$_POST['total_death_update'];
		$new_death=$_POST['new_death_update'];
		// echo $total_case;
		$object->countryInfoUpdate($id,$total_case,$new_case,$total_death,$new_death);
		echo "data updated successfully!!!!";
	}

	//business org portion

	if(isset($_POST['org_add_modal']))
	{
		$output='
			<div class="modal-header">
				<h5 class="modal-title">Add Medical Org</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="org_add_form">
				<div class="modal-body">
					  <div class="form-group">
					    <label >Org Name</label>
					    <input type="text" class="form-control" name="org_name" placeholder="Medical Name" required>
					  </div>  
					  <div class="form-group">
					    <label >Org Location</label>
					    <input type="text" class="form-control" name="org_location" placeholder="Medical Location" required>
					  </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="add_org()">Add</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>
		';

		echo $output;
	}

	if(isset($_POST['org_name']))
	{
		$org_name=$_POST['org_name'];
		$org_location=$_POST['org_location'];
		$object->add_org($org_name,$org_location);

	}

	// org edited option
	if(isset($_POST['org_id']))
	{
		$org_id=$_POST['org_id'];
		$result=$object->organizationInfo($org_id);
		$output=' 
			<div class="modal-header">
				<h5 class="modal-title">Edit '.$result['name'].' Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="org_info_edited">
				<div class="modal-body">
					<div class="form-group">
						<label >Org Name</label>
						<input type="text" class="form-control" name="org_name_edited" value="'.$result['name'].'">
					</div>
					 <div class="form-group">
						<label >Org Location</label>
						<input type="text" class="form-control" name="org_location_edited" value='.$result['location'].'>
					</div> 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" onclick="org_update('.$result['id'].')">Save changes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</form>

		 ';

		 echo $output;

	}
	// org update portion
	if(isset($_POST['org_name_edited']))
	{
		$org_id=$_POST['org_id'];
		$name=$_POST['org_name_edited'];
		$location=$_POST['org_location_edited'];
		$object->orgInfoEdit($org_id,$name,$location);
	}

	//org delete portion
	if(isset($_POST['org_id_delete']))
	{
		$org_id=$_POST['org_id_delete'];
		$object->user_delete($org_id);
	}







?>







