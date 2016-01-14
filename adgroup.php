<?php
require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 

$id = $_GET['id']; 
$campaignId = $id;

function AddAdGroups(AdWordsUser $user, $campaignId,$name) {
	$adwords_version = "v201509";
  // Get the service, which loads the required classes.
  $adGroupService = $user->GetService('AdGroupService', $adwords_version);

  $numAdGroups = 1;
  $operations = array();
  for ($i = 0; $i < $numAdGroups; $i++) {
    // Create ad group.
    $adGroup = new AdGroup();
    $adGroup->campaignId = $campaignId;
    $adGroup->name = $name;

    // Set bids (required).
    $bid = new CpcBid();
    $bid->bid =  new Money(1000000);
    $biddingStrategyConfiguration = new BiddingStrategyConfiguration();
    $biddingStrategyConfiguration->bids[] = $bid;
    $adGroup->biddingStrategyConfiguration = $biddingStrategyConfiguration;

    // Set additional settings (optional).
    $adGroup->status = 'ENABLED';

    // Targeting restriction settings - these settings only affect serving
    // for the Display Network.
    $targetingSetting = new TargetingSetting();
    // Restricting to serve ads that match your ad group placements.
    // This is equivalent to choosing "Target and bid" in the UI.
    $targetingSetting->details[] =
        new TargetingSettingDetail('PLACEMENT', false);
    // Using your ad group verticals only for bidding. This is equivalent
    // to choosing "Bid only" in the UI.
    $targetingSetting->details[] =
        new TargetingSettingDetail('VERTICAL', true);
    $adGroup->settings[] = $targetingSetting;

    // Create operation.
    $operation = new AdGroupOperation();
    $operation->operand = $adGroup;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupService->mutate($operations);

  // Display result.
  $adGroups = $result->value;
  foreach ($adGroups as $adGroup) {
    echo "Ad group with name" .$adGroup->name. " and ID ". $adGroup->id." was added.";
  }
}
if(@$_POST['submit']){

  $name = $_POST['name']; 

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  AddAdGroups($user,$campaignId,$name ,$channel);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());

}  } ?>
<form action="" method="post" >
<label>Name</label> 
<input type="text" name="name" value=""><br>
<input type="submit" name="submit" value="submit"><br>
</form>
