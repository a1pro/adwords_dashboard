<?php

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version ="v201509";
$id = $_GET['id']; 
$campaignId = $id;

function UpdateCampaign(AdWordsUser $user, $campaignId) {
  // Get the service, which loads the required classes.
  $campaignService = $user->GetService('CampaignService', $adwords_version);

  // Create campaign using an existing ID.
  $campaign = new Campaign();
  $campaign->id = $campaignId;
  $campaign->status = 'PAUSED';

  // Create operation.
  $operation = new CampaignOperation();
  $operation->operand = $campaign;
  $operation->operator = 'SET';

  $operations = array($operation);

  // Make the mutate request.
  $result = $campaignService->mutate($operations);

  // Display result.
  $campaign = $result->value[0];
  echo "Campaign with ID '%s' was paused.\n", $campaign->id;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  UpdateCampaign($user, $campaignId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}





?>