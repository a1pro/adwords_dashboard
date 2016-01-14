<?php
  require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
  $adwords_version ="v201509";

function AddCampaigns(AdWordsUser $user,$name,$channel) {
  $adwords_version ="v201509";
  // Get the BudgetService, which loads the required classes.
  $budgetService = $user->GetService('BudgetService', $adwords_version);
  //print_r($budgetService);
  // Create the shared budget (required).
  $budget = new Budget();
  $budget->name = $name. uniqid();
  $budget->period = 'DAILY';
  $budget->amount = new Money(50000000);
  $budget->deliveryMethod = 'STANDARD';

  $operations = array();

  // Create operation.
  $operation = new BudgetOperation();
  $operation->operand = $budget;
  $operation->operator = 'ADD';
  $operations[] = $operation;

   // Make the mutate request.
  $result = $budgetService->mutate($operations);
  $budget = $result->value[0];

  // Get the CampaignService, which loads the required classes.
  $campaignService = $user->GetService('CampaignService', $adwords_version);

  $numCampaigns = 1;
  $operations = array();
  for ($i = 0; $i < $numCampaigns; $i++) {
    // Create campaign.
    $campaign = new Campaign();
    $campaign->name = $name . uniqid();
    $campaign->advertisingChannelType = $channel;

    // Set shared budget (required).
    $campaign->budget = new Budget();
    $campaign->budget->budgetId = $budget->budgetId;

    // Set bidding strategy (required).
    $biddingStrategyConfiguration = new BiddingStrategyConfiguration();
    $biddingStrategyConfiguration->biddingStrategyType = 'MANUAL_CPC';

    // You can optionally provide a bidding scheme in place of the type.
    $biddingScheme = new ManualCpcBiddingScheme();
    $biddingScheme->enhancedCpcEnabled = false;
    $biddingStrategyConfiguration->biddingScheme = $biddingScheme;

    $campaign->biddingStrategyConfiguration = $biddingStrategyConfiguration;

    // Set network targeting (optional).
    $networkSetting = new NetworkSetting();
    $networkSetting->targetGoogleSearch = true;
    $networkSetting->targetSearchNetwork = true;
    $networkSetting->targetContentNetwork = true;
    $campaign->networkSetting = $networkSetting;

    // Set additional settings (optional).
    $campaign->status = 'PAUSED';
    $campaign->startDate = date('Ymd', strtotime('+1 day'));
    $campaign->endDate = date('Ymd', strtotime('+1 month'));
    $campaign->adServingOptimizationStatus = 'ROTATE';

    // Set frequency cap (optional).
    $frequencyCap = new FrequencyCap();
    $frequencyCap->impressions = 5;
    $frequencyCap->timeUnit = 'DAY';
    $frequencyCap->level = 'ADGROUP';
    $campaign->frequencyCap = $frequencyCap;

    // Set advanced location targeting settings (optional).
    $geoTargetTypeSetting = new GeoTargetTypeSetting();
    $geoTargetTypeSetting->positiveGeoTargetType = 'DONT_CARE';
    $geoTargetTypeSetting->negativeGeoTargetType = 'DONT_CARE';
    $campaign->settings[] = $geoTargetTypeSetting;

    // Create operation.
    $operation = new CampaignOperation();
    $operation->operand = $campaign;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $campaignService->mutate($operations);

  // Display results.
  foreach ($result->value as $campaign) {
    echo "Campaign with name '%s' and ID '%s' was added.\n", $campaign->name,$campaign->id;
  
  }
}
if(@$_POST['submit']){

  $name = $_POST['name'];
  $channel = $_POST['channel'];

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  AddCampaigns($user,$name,$channel);
} catch (Exception $e) {
  echo "An error has occurred: %s\n", $e->getMessage();
} 

}

?>
<form action="" method="post" >
<label>Name</label> 
<input type="text" name="name" value=""><br>
<label>Advertising Channel Type</label> 
<input type="text" name="channel" value=""><br>
<input type="submit" name="submit" value="submit"><br>
</form>
