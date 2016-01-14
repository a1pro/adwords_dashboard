<?php 

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
$id = $_GET['adgrp_id'];
$adGroupId = $id;


function AddKeywords(AdWordsUser $user, $adGroupId) {
  $adwords_version ="v201509";
  // Get the service, which loads the required classes.
  $adGroupCriterionService = $user->GetService('AdGroupCriterionService', $adwords_version);

  $numKeywords = 5;
  $operations = array();
  for ($i = 0; $i < $numKeywords; $i++) {
    // Create keyword criterion.
    $keyword = new Keyword();
    $keyword->text = 'mars cruise ' . uniqid();
    $keyword->matchType = 'BROAD';

    // Create biddable ad group criterion.
    $adGroupCriterion = new BiddableAdGroupCriterion();
    $adGroupCriterion->adGroupId = $adGroupId;
    $adGroupCriterion->criterion = $keyword;

    // Set additional settings (optional).
    $adGroupCriterion->userStatus = 'PAUSED';
    $adGroupCriterion->finalUrls = array('http://www.example.com/mars');

    // Set bids (optional).
    $bid = new CpcBid();
    $bid->bid =  new Money(500000);
    $biddingStrategyConfiguration = new BiddingStrategyConfiguration();
    $biddingStrategyConfiguration->bids[] = $bid;
    $adGroupCriterion->biddingStrategyConfiguration =
        $biddingStrategyConfiguration;

    $adGroupCriteria[] = $adGroupCriterion;

    // Create operation.
    $operation = new AdGroupCriterionOperation();
    $operation->operand = $adGroupCriterion;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupCriterionService->mutate($operations);

  // Display results.
  foreach ($result->value as $adGroupCriterion) {
    echo "Keyword with text".$adGroupCriterion->criterion->text." match type".$adGroupCriterion->criterion->matchType. "and ID" .$adGroupCriterion->criterion->id."was added";       
    
  }
}



try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  AddKeywords($user, $adGroupId);

} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}

?>