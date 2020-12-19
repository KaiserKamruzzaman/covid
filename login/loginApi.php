<?php
	session_start();
	include "../controller/class.crud.php";
	$object=new Crud();
	$email=$_POST['email'];
	$password=$_POST['password'];
	$result=$object->login($email,$password);
	// var_dump($result);
	if($result)
	{
		$_SESSION["user_name"] = $result['name'];
		$_SESSION["user_email"] = $result['email'];
		$_SESSION["user_type"] = $result['type'];
		$_SESSION["user_id"] = $result['id'];
		if($_SESSION["user_type"]==1)
		{
			echo '1';
		}
		else{
			echo '2';
		}
	}
	else
	{
		echo 'failed';
	}


	
?>