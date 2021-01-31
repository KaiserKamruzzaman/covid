<?php
	include "../controller/class.crud.php";
	$object=new Crud();

	if(isset($_POST["org_id"]))
	{
		$user_id=$_POST["user_id"];
		$org_id=$_POST["org_id"];
		$comment=$_POST["comment"];

		echo $org_id;
		echo '</br>';
		echo $comment;

	}

?>