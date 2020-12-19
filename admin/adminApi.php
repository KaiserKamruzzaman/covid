<?php
	include "../controller/class.Crud.php";
	$object=new Crud();

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





?>