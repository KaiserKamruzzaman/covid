<?php

	$arr=array(1,2,3,4);
	$new=array();
	foreach ($arr as $res) {
		$try="'$res'";
		// echo $try.'</br>';
		array_push($new,$try);
	}
	var_dump($new);
?>