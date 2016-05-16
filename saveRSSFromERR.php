<?php

require_once("dbcontroller.php");
$db_handle_insert = new DBController();

$myDOM = new DOMDocument();
$myDOM->load("http://www.err.ee/rss"); // XMLi URL

$content = $myDOM->getElementsByTagName("item");

$sql_del = "DELETE FROM uudised";

CRUDactivity($db_handle_insert, $sql_del);

/*
 * Kõigi elementide läbikäimine salvestamaks need andmebaasi
 * igaüks eraldi reana
 */
try {
	foreach($content as $data) {
		
		$title = $data->getElementsByTagName("title")->item(0)->nodeValue;
		$link = $data->getElementsByTagName("link")->item(0)->nodeValue;
	   
		$date = $data->getElementsByTagName("pubDate")->item(0)->nodeValue;
		$descr = $data->getElementsByTagName("description")->item(0)->nodeValue;
		
		$sql = "INSERT INTO uudised (pealkiri, link, kuupaev, sissejuhatus)
		VALUES ('$title', '$link', '$date', '$descr')";
		
		CRUDactivity($db_handle_insert, $sql);
		
	}
	
	// Ühenduse sulgemine andmebaasiga
	$db_handle_insert->closeConnection();
}
catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}

/*
 * Andmebaasiga seotud lisamise ja kustutamise tegevused
 */
function CRUDactivity($db_handle_insert, $sql) {
	if (mysqli_query($db_handle_insert->getConn(), $sql)) {
	//
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($db_handle_insert->getConn());
	}
}

?>