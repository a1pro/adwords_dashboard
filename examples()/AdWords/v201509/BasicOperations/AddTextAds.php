<?php

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version ="v201509";
$adGroupId = '374872879';
function AddTextAdsExample(AdWordsUser $user, $adGroupId) {
  // Get the service, which loads the required classes.
  $adGroupAdService = $user->GetService('AdGroupAdService', ADWORDS_VERSION);

  $numAds = 5;
  $operations = array();
  for ($i = 0; $i < $numAds; $i++) {
    // Create text ad.
    $textAd = new TextAd();
    $textAd->headline = 'Cruise #' . uniqid();
    $textAd->description1 = 'Visit the Red Planet in style.';
    $textAd->description2 = 'Low-gravity fun for everyone!';
    $textAd->displayUrl = 'www.example.com';
    $textAd->finalUrls = array('http://www.example.com');

    // Create ad group ad.
    $adGroupAd = new AdGroupAd();
    $adGroupAd->adGroupId = $adGroupId;
    $adGroupAd->ad = $textAd;

    // Set additional settings (optional).
    $adGroupAd->status = 'PAUSED';

    // Create operation.
    $operation = new AdGroupAdOperation();
    $operation->operand = $adGroupAd;
    $operation->operator = 'ADD';
    $operations[] = $operation;
  }

  // Make the mutate request.
  $result = $adGroupAdService->mutate($operations);

  // Display results.
  foreach ($result->value as $adGroupAd) {
    printf("Text ad with headline '%s' and ID '%s' was added.\n",
        $adGroupAd->ad->headline, $adGroupAd->ad->id);
  }
}

// Don't run the example if the file is being included.
if (__FILE__ != realpath($_SERVER['PHP_SELF'])) {
  return;
}

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  AddTextAdsExample($user, $adGroupId);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
