<?php
// Cache rakendamine
include('topCache.php');
?>
<html>
<head>
<title>ERR uudised</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.2.6.pack.js"></script><!--  -->

<script src="js/rssNewsScripts.js"></script>

<link rel="stylesheet" type="text/css" href="css/rssNewsStyle.css">

</head>

<body>
<div id="rss-uudised">
	<div class=\"col-xs-12 col-md-12\">
		<div>
			<h1 class="text-primary">ERRi RSS uudised</h1>
		</div>
		
		
		<?php 
		//cache'i testimine
		//echo date('H:i:s') . "<br>";;
		?>
		<?php include('saveRSSFromERR.php'); ?>
		<?php include('getResult.php'); ?>
		<div id="loader-icon"><img src="img/LoaderIcon.gif" /><div>
	</div>
</div>


</body>
</html>
<?php
include('bottomCache.php');
?>