<?php

	/*
		Date : Wed Mar 11 25:00:41
		Author : Tourahi Amine
	*/

	function WriteToJson($filename,$Data) {
		$fp = fopen("{$filename}", 'w+');
		fwrite($fp, json_encode($Data));
		fclose($fp);
	}

	function AppendToJson($filename,$Data) {
	$data_results = file_get_contents("{$filename}");
	$tempArray = json_decode($data_results);
	$tempArray[] = $Data ;	
	file_put_contents("{$filename}", json_encode($tempArray));  
	}


  ?>