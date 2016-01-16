<?php 
include('function.php');
require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
$adwords_version ="v201509"; 

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Google Adwords</title>

		<!-- Css Start -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link href="fonts/calibri/stylesheet.css" rel="stylesheet">	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>		
		<script src="custom.js"></script>
		 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>		
		<script>
		$(function() {
		$( "#datepicker" ).datepicker();
		});
		$(function() {
		$( "#datepicker1" ).datepicker();
		});
		</script>	
	</head>
