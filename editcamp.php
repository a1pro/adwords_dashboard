<?php

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version ="v201509";
$value = $_GET['value'];
if($value=="_re"){

$state = "ENABLED";

}elseif($value=="_rp"){

$state = "PAUSED";

}elseif($value=="_rr"){

  $state = "PAUSED";
}
$id = $_GET['c_id']; 
$campaignId = $id;

function UpdateCampaign(AdWordsUser $user, $campaignId,$state) {
  // Get the service, which loads the required classes.
  $campaignService = $user->GetService('CampaignService', $adwords_version);

  // Create campaign using an existing ID.
  $campaign = new Campaign();
  $campaign->id = $campaignId;
  $campaign->status = $state;

  // Create operation.
  $operation = new CampaignOperation();
  $operation->operand = $campaign;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Make the mutate request.
  $result = $campaignService->mutate($operations);

  // Display result.
  $campaign = $result->value[0]; ?>
 <script>
    window.location="adwords_dashboard.php";
 </script>

<?php }

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  UpdateCampaign($user, $campaignId,$state);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}





?>
