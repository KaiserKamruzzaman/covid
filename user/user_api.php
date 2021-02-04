<?php
	session_start();
	include "../controller/class.crud.php";
	$object=new Crud();
	$id=$_POST['user_id'];
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$country=$_POST['country'];

	$object->user_update($id,$name,$email,$password,$country);
	header('Location: index.php');

?>