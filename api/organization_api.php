<?php
	include "../controller/class.crud.php";
	$object=new Crud();

	// comment insert
	if(isset($_POST["org_id"]))
	{
		$user_id=$_POST["user_id"];
		$org_id=$_POST["org_id"];
		$comment=$_POST["comment"];
		$object->insert_comment($user_id,$org_id,$comment);
	}

	if(isset($_POST["org_ratings"]))
	{
		$ratings_user_id=$_POST["ratings_user_id"];
		$ratings_org_id=$_POST["ratings_org_id"];
		$org_ratings=$_POST["org_ratings"];

		$object->org_ratings($ratings_user_id,$ratings_org_id,$org_ratings);
	}

?>