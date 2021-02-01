<?php
	session_start();
	include "../controller/class.crud.php";
	$object=new Crud();

	$name=$_POST['user_name'];
	$email=$_POST['user_email'];
	$password=$_POST['user_pass'];
	$country=$_POST['user_country'];
	$object->sign_up($name,$email,$password,$country);
	header('Location: index.php');

?>