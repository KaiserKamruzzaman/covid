<?php
	include "../controller/class.Crud.php";
	$object=new Crud();


	// csv file upload section
	if(isset($_POST["submit"]))
	{
	 if($_FILES['file']['name'])
	 {
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
	   		$object->uploadCsv($d);
	   }
	   // echo "<script>alert('Import done');</script>";
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





?>


