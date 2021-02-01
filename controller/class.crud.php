<?php
	include "class.database.php";

	class Crud extends Database{

		public function login($email,$password)
		{
			$sql="SELECT * FROM `user` WHERE `email`='$email' AND `password`='$password'";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch();
			return $row;
		}

		public function uploadCsv($data)
		{
			$country=$data[0];
			$total_case=$data[1];
			$new_case=$data[2];
			$total_death=$data[3];
			$new_death=$data[4];
			$trans_type=$data[5];
			$pub_date=$data[6];
			$pub_date=date_create($pub_date);
			$pub_date=date_format($pub_date,"Y-m-d");

			$sql = "INSERT INTO covid_data (country, total_case, new_case, total_death, new_death, trans_type,pub_date)
			 		VALUES ('$country','$total_case','$new_case','$total_death','$new_death','$trans_type','$pub_date')";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
	   		
		}

		public function covidInfo()
		{
			$sql="SELECT * FROM `covid_data` where DATE(`pub_date`)=CURDATE() ";
			$row=array();
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetchAll();
			return $row;
		}

		//country specific covid data...
		public function countryCovidInfo($id)
		{
			$sql="SELECT `country` FROM `covid_data` WHERE `id`='$id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$country_name=$stmt->fetch();
			$country_name=$country_name['country'];

			// echo $country_name;


			$query="SELECT * FROM `covid_data` WHERE `country`='$country_name' ORDER BY `pub_date` DESC LIMIT 30 ";
			$row=array();
			$stmt = $this->con->prepare($query);
			$stmt->execute();
			$row=$stmt->fetchAll();
			return $row;
			
		}
		// info for a specific country
		public function countryInfo($id)
		{
			$sql="SELECT * FROM `covid_data` WHERE `id`='$id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch();
			return $row;
		}

		public function countryInfoUpdate($id,$total_case,$new_case,$total_death,$new_death)
		{
			$sql="UPDATE `covid_data` SET `total_case`='$total_case',`new_case`='$new_case',`total_death`='$total_death',`new_death`='$new_death' WHERE id='$id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
		}

		// add organization
		public function add_org($org_name,$org_location)
		{
			$sql = "INSERT INTO `organizations`(`name`, `location`) VALUES ('$org_name', '$org_location')";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
		}
		// show organizations
		public function show_organizations()
		{
			$sql='SELECT * FROM `organizations` ';
			$row=array();
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetchAll();
			return $row;
		}

		public function organizationInfo($id)
		{
			$sql="SELECT * FROM `organizations` WHERE `id`='$id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch();
			return $row;
		}
		// edit organizations
		public function orgInfoEdit($id,$name,$location)
		{
			$sql="UPDATE `organizations` SET `name`='$name',`location`='$location' WHERE `id`='$id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
		}

		// comment section start

		public function insert_comment($user_id,$org_id,$comment)
		{
			$sql="INSERT INTO `comments`(`user_id`, `org_id`, `comment`) VALUES('$user_id','$org_id','$comment')";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
		}

		// view all commet of an org

		public function view_comments($org_id)
		{
			$sql="SELECT * FROM `comments` WHERE `org_id`='$org_id' ORDER BY `inserted_at` DESC";
			$row=array();
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetchAll();
			return $row;
		}

		// view comment ower
		public function comment_owner($user_id)
		{
			$sql="SELECT * FROM `user` WHERE `id`='$user_id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch();
			return $row;
		}

		// give org_ratings
		public function org_ratings($user_id,$org_id,$ratings)
		{
			$sql="SELECT * FROM `ratings` WHERE `user_id`='$user_id' AND `org_id`='$org_id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$user=$stmt->fetch();

			if($user)
			{
				//update
				$sql="UPDATE `ratings` SET `rating`='$ratings' WHERE `user_id`='$user_id' AND `org_id`='$org_id' ";
				$stmt = $this->con->prepare($sql);
				$stmt->execute();
			}
			else{
				//insert
				$sql="INSERT INTO `ratings`(`user_id`, `org_id`, `rating`) VALUES('$user_id','$org_id','$ratings')";
				$stmt = $this->con->prepare($sql);
				$stmt->execute();
			}
			
		}

		//average rating
		public function avg_rating($org_id)
		{
			$sql="SELECT AVG(`rating`) AS `avg_rating` FROM ratings WHERE `org_id`='$org_id' ";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
			$row=$stmt->fetch();
			return $row;
		}

		//signup user
		public function sign_up($name,$email,$pass,$country)
		{
			$sql="INSERT INTO `user`(`name`, `email`, `password`, `country`, `type`) VALUES('$name','$email','$pass','$country','2')";
			$stmt = $this->con->prepare($sql);
			$stmt->execute();
		}


	}



?>