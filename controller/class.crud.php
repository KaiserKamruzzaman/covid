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







	}



?>