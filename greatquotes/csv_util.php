<?php

//prints full csv file into array.
function readcsv($filename){
	$f = fopen($filename,"r");
	while ($record = fgetcsv($f)) {
		$arr[] = $record;
	}
	fclose($f);
	return $arr;
}

//reads one line of a csv file based on the index (named element).
function readonecsv($filename,$element){
	$counter = 0;
	$f = fopen($filename,"r");
	while ($record = fgetcsv($f)){
		if ($counter == $element){
			$arr = $record;
		}
		$counter++;
	}
	fclose($f);
	return $arr;
}

//adds one line into csv file at the end by appending.
function addcsv($filename,$addinfo){
	$infoarray = array($addinfo);
	$f = fopen($filename,"a");
	fputcsv($f,$addinfo);
	fclose($f);
}

//changes one line of csv file. You must give the index (element), and the info (addinfo).
function modcsv($filename,$element,$addinfo){
	$infoarray = array($addinfo);
	$counter = 0;
	$f = fopen($filename,"r");
	while ($record = fgetcsv($f)){
		if ($counter == $element){
			$arr[] = $addinfo;
		}
		else{
			$arr[] = $record;
		}
		$counter++;
	}
	fclose($f);

	$counter = 0;
	$fw = fopen($filename,"w");
	foreach($arr as $rows){
		fputcsv($fw,$rows);
	}
	fclose($fw);
	return $arr;
}

//leaves one line blank based on your choice using index.
function leaveblank($filename,$element){
	$counter = 0;
	$f = fopen($filename,"r");
	while ($record = fgetcsv($f)){
		if ($counter == $element){
			$arr[] = array("");
		}
		else{
			$arr[] = $record;
		}
		$counter++;
	}
	fclose($f);

	$fw = fopen($filename,"w");
	foreach($arr as $rows){
		fputcsv($fw,$rows);
	}
	fclose($fw);
	return $arr;
}

//fully deletes a line based on index.
function delfull($filename,$element){
	$counter = 0;
	$f = fopen($filename,"r");
	while ($record = fgetcsv($f)){
		if ($counter != $element){
			$arr[] = $record;
		}
		$counter++;
	}
	fclose($f);

	$fw = fopen($filename,"w");
	foreach($arr as $rows){
		fputcsv($fw,$rows);
	}
	fclose($fw);
	return $arr;
}

?>