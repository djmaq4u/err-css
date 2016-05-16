<?php


require_once("dbcontroller.php");
$db_handle = new DBController();
$perPage = 10;

$sql = "SELECT * FROM uudised";

$page = 1;

if(!empty($_GET["page"])) {
	$page = $_GET["page"];
}

$start = ($page-1)*$perPage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage;
$faq = $db_handle->runQuery($query);

if(empty($_GET["rowcount"])) {
	$_GET["rowcount"] = $db_handle->numRows($sql);
}

$pages  = ceil($_GET["rowcount"]/$perPage);
$output = '';

if(!empty($faq)) {
	$output .= '<input type="hidden" class="pagenum" value="' . $page . '" /><input type="hidden" class="total-page" value="' . $pages . '" />';
	
	foreach($faq as $k=>$v) {
		$output .=  '<div class="pealkiri">' . $faq[$k]["pealkiri"] . '</div>';
		
		date_default_timezone_set("Europe/Tallinn");
		
		setlocale(LC_ALL, 'Estonia', 'et_EE', 'et', 'EE', 'ET');
		
		//$time = convertDate($faq[$k]["kuupaev"]);
		//$output .=  '<div class="kuupaev">' . $time . '</div>';
		
		$time = strtotime($faq[$k]["kuupaev"]);
		
		$month = date('M', $time);

		/*
		 * Ingliskeelsete kuude nimetuste "lülitamine" eestikeelseteks
		 */
		switch ($month) {
			case "Jan":
				$month = "jaanuar";
				break;
			case "Feb":
				$month = "veebruar";
				break;
			case "Mar":
				$month = "märts";
				break;
			case "Apr":
				$month = "aprill";
				break;
			case "May":
				$month = "mai";
				break;
			case "June":
				$month = "juuni";
				break;
			case "July":
				$month = "juuli";
				break;
			case "Aug":
				$month = "august";
				break;
			case "Sept":
				$month = "september";
				break;
			case "Oct":
				$month = "oktoober";
				break;
			case "Nov":
				$month = "november";
				break;
			case "Dec":
				$month = "detsember";
		}
		
		/*
		 * Kuupäeva konstrueerimine
		 */
		$output .=  '<div class="kuupaev">' . date('j. ', $time) . $month . date(' Y H:i', $time) . '</div>';
		
		$output .= '<div class="sissejuhatus">' . $faq[$k]["sissejuhatus"] . '</div>';
	}
}

print $output;

?>
