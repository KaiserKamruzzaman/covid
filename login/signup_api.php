<?php
	session_start();
	include "../controller/class.crud.php";
	$object=new Crud();

	$name=$_POST['user_name'];
	$email=$_POST['user_email'];
	$password=$_POST['user_pass'];
	$country=$_POST['user_country'];
	// image upload section
	$target_dir = "../uploads/images/";
	$target_file = $target_dir . basename($_FILES["file"]["name"]);
	$file_name=basename($_FILES["file"]["name"]);

	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["file"]["tmp_name"]);
	if($check !== false) {
	echo "File is an image - " . $check["mime"] . ".";
	$uploadOk = 1;
	} else {
	// echo "File is not an image.";
	$_SESSION['message'] = 'File is not an image.';
	$uploadOk = 0;
	}


	// Check if file already exists
	if (file_exists($target_file)) {
	  // echo "Sorry, file already exists.";
	  $_SESSION['message'] = 'Sorry, file already exists.';
	  $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["file"]["size"] > 500000) {
	  // echo "Sorry, your file is too large.";
	   $_SESSION['message'] = 'Sorry, your file is too large.';
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $_SESSION['message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  // echo "Sorry, your file was not uploaded.";
		$_SESSION['message'] = 'Sorry, your file was not uploaded.';
		header('Location: signup.php');
	// if everything is ok, try to upload file
	}
	else 
	{
		// store user info
	  $object->sign_up($name,$email,$password,$country,$file_name);

	  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
	    echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
	    header('Location: index.php');
	  } else {
	    echo "Sorry, there was an error uploading your file.";
	    header('Location: signup.php');
	  }
	}
	// $object->sign_up($name,$email,$password,$country);
	// header('Location: index.php');

?>