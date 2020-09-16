<?php
	/*
		Date : Wed Mar 11 22:28:23 
		Author : Tourahi Amine
	*/


	function GetData($filename) {   
		$file = fopen($filename, 'r');
		$MyData = [];
		while (($data = fgetcsv($file, 1000, ",")) !== FALSE) 
		{
		   $MyData[] = $data;
		}
		fclose($file);
		return $MyData;
	}

	function AppendData($filename,$Data) {
	//$Data format => array ( array(-row-), array(-row-), array(-row-))
		$file = fopen("{$filename}", 'a+');

		foreach ($Data as $fields) {
	        fputcsv($file, $fields);
	    }
	    fclose($file);
	    idDistribution($filename);
	}

	function EmptyFile($filename) {
		$file = fopen("{$filename}", 'w');
		$Data = [];
		foreach ($Data as $fields) {
	        fputcsv($file, $fields);
	    }
	    fclose($file);
	}

	function UpdateData($filename,$Data) {
		$file = fopen("{$filename}", 'w');

		foreach ($Data as $fields) {
	        fputcsv($file, $fields);
	    }

	    fclose($file);
	    idDistribution($filename);
	}

	function DeleteRow($filename,$row){  
	//id System (Every File must be tracked by an id(Unique FOR every row)); 
	//Si appeler 2 fois consecutives fai attention au $row de le 2em appele	
		$MyData = [];
		$newData =[];
		$j = 0;
		$MyData = GetData($filename);
		for($i = 0;$i < 3;$i++) {
			if($MyData[$i][0] !=  $row) {
				$newData[$j] = $MyData[$i];
				$j+=1;
			}
		}
		UpdateData($filename,$newData);
	}

	function idDistribution($filename) { 
		$Data = GetData($filename);
        $j = 0;

		for($i = 0;$i < sizeof($Data);$i++) {
			$Data[$i][0] = $j;
			$j++;
		}

		$file = fopen("{$filename}", 'w');

		foreach ($Data as $fields) {
	        fputcsv($file, $fields);
	    }

	    fclose($file);
	}

?>