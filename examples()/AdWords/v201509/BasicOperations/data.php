<?php 
echo "heloooo";
$output = shell_exec('php GetCampaigns.php');
echo "<pre>".$output."</pre>";
?>