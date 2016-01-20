<?php

function GetCampaigns(AdWordsUser $user, $adwords_version) {
	// Get the service, which loads the required classes.
	$campaignService = $user->GetService('CampaignService', $adwords_version);
    // Create selector.					 
    $selector = new Selector();
    $selector->fields = array('Id', 'Name', 'Status' ,'Amount','AdvertisingChannelType','AdvertisingChannelSubType','Labels','BidCeiling','FrequencyCapMaxImpressions');
    $selector->ordering[] = new OrderBy('Name', 'ASCENDING');

    // Filter out deleted criteria.
    $selector->predicates[] = new Predicate('Status', 'NOT_IN', array('REMOVED'));

    // Create paging controls.
    $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

    $ret = array();
    do {
        // Make the get request.
        $page = $campaignService->get($selector);
      	// Display results.
       if (isset($page->entries)) {
            foreach ($page->entries as $campaign) {	
                $ret[] = array(
                    'name' => $campaign->name,
                    'id' => $campaign->id,					                  
                    'active' => $campaign->status,
                    'budget' => $campaign->budget->amount->microAmount,
                    'campaignsubtype'=>$campaign->advertisingChannelSubType,
                    'campaigntype'=>$campaign->advertisingChannelType,
                    'impressions'=>$campaign->frequencyCap->impressions,
                    'labels' =>$campaign->labels

                );
            }
        } else {
            echo "No campaigns were found.\n";
        }
        // Advance the paging index.
        $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
    } while ($page->totalNumEntries > $selector->paging->startIndex);
   
    return $ret;
}



function AddCampaigns(AdWordsUser $user,$name,$channel,$typeinfo,$amount,$stdate,$etdate) {
   $adwords_version ="v201509";
 
  // Get the BudgetService, which loads the required classes.
  $budgetService = $user->GetService('BudgetService', $adwords_version);

  // Create the shared budget (required).
  $budget = new Budget();
  $budget->name = $name;
  $budget->period = 'DAILY';
  $budget->amount = new Money($amount);
  
  $budget->deliveryMethod = $typeinfo;

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
    $campaign->name = $name;
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
    $campaign->startDate = $stdate;
    //date('Ymd', strtotime('+1 day'));
    $campaign->endDate = $etdate;
    //date('Ymd', strtotime('+1 month'));
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
  echo "Campaign has added";
  // Display results.
  //foreach ($result->value as $campaign) {
//  echo "Campaign with name".$campaign->name."and ID".$campaign->id." has  added";
  
//  }
}

function AddAdGroups(AdWordsUser $user, $campaignId,$name,$amount) {
	//echo $amount;die();
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
	    $bid->bid =  new Money($amount);
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




function GetAdGroup(AdWordsUser $user, $adwords_version) {
    // Get the service, which loads the required classes.
    $adgroupService = $user->GetService('AdGroupService', $adwords_version);

    // Create selector.
    $selector = new Selector();
    $selector->fields = array('Id', 'Name', 'CampaignId', 'Status','CpcBid','CampaignName');
    $selector->ordering[] = new OrderBy('CampaignId', 'ASCENDING');

    // Filter out deleted criteria.
    $selector->predicates[] = new Predicate('Status', 'NOT_IN', array('REMOVED','PAUSED'));

    // Create paging controls.
    $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

    $ret = array();
    do {
        // Make the get request.
        $page = $adgroupService->get($selector);      
        // Display results.
        if (isset($page->entries)) {
            foreach ($page->entries as $adgroup) {
                //printf("AdGroup with name '%s' and id '%s' was found for Campaign: '%s' and Status: '%s'\n",
                // $adgroup->name, $adgroup->id, $adgroup->campaignId, $adgroup->status);
                $ret[] = array(
                    'name' => $adgroup->name,
                    'id' => $adgroup->id,
                    'campaignId' => $adgroup->campaignId,
                    'campaignName' => $adgroup->campaignName,
                    'cpc' => $adgroup->biddingStrategyConfiguration->bids->bid->microAmount,
                    'active' => $adgroup->status
                );
            }
        } else {
            echo  "No adgroups were found.";
        }
        // Advance the paging index.
        $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
    } while ($page->totalNumEntries > $selector->paging->startIndex);   
      
    return $ret;
}


function GetadgrpCampaigns(AdWordsUser $user, $adwords_version,$camp_id) {
  // Get the service, which loads the required classes.
  $campaignService = $user->GetService('CampaignService', $adwords_version);
    // Create selector.          
    $selector = new Selector();
    $selector->fields = array('Id', 'Name', 'Status');
    $selector->ordering[] = new OrderBy('Name', 'ASCENDING');

    // Filter out deleted criteria.
    $selector->predicates[] = new Predicate('Id','IN',$camp_id);

    // Create paging controls.
    $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

    $ret = array();
    do {
        // Make the get request.
        $page = $campaignService->get($selector);
        // Display results.
       if (isset($page->entries)) {
            foreach ($page->entries as $campaign) { 
                $ret[] = array(
                    'name' => $campaign->name,
                    'id' => $campaign->id,                            
                    'active' => $campaign->status
                );
            }
        } else {
          $result="no";
           return $result;
        }
        // Advance the paging index.
        $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
    } while ($page->totalNumEntries > $selector->paging->startIndex);
   
    return $ret;
}

function AddTextAds($user,$adGroupId,$headline,$desc1,$desc2,$displayurl,$finalurl) {
  // Get the service, which loads the required classes.
  $adGroupAdService = $user->GetService('AdGroupAdService', $adwords_version);

  $numAds = 1;
  $operations = array();
  for ($i = 0; $i < $numAds; $i++) {
    // Create text ad.
    $textAd = new TextAd();
    $textAd->headline = $headline;
    $textAd->description1 = $desc1;
    $textAd->description2 = $desc2;
    $textAd->displayUrl = $displayurl;
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


function GetTextAds(AdWordsUser $user, $adwords_version) {
  // Get the service, which loads the required classes.
  $adGroupAdService = $user->GetService('AdGroupAdService',$adwords_version);

  // Create selector.
  $selector = new Selector();
  $selector->fields = array('Headline', 'Id');
  $selector->ordering[] = new OrderBy('Headline', 'ASCENDING');

  // Create predicates.
  //$selector->predicates[] = new Predicate('AdGroupId', 'IN', array($adGroupId));
  $selector->predicates[] = new Predicate('AdType', 'IN', array('TEXT_AD'));
  // By default disabled ads aren't returned by the selector. To return them
  // include the DISABLED status in a predicate.
  $selector->predicates[] = new Predicate('Status', 'IN', array('ENABLED', 'PAUSED', 'DISABLED'));

  // Create paging controls.
  $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

  do {
    // Make the get request.
    $page = $adGroupAdService->get($selector);
       
    // Display results.
    if (isset($page->entries)) {
      foreach ($page->entries as $adGroupAd) {

        $ret[] = array(
          'headline' => $adGroupAd->ad->headline,
          'id' => $adGroupAd->ad->id

        );
        /*printf("Text ad with headline '%s' and ID '%s' was found.\n",
            $adGroupAd->ad->headline, $adGroupAd->ad->id);*/
      }
    } else {
      print "No text ads were found.\n";
    }

    // Advance the paging index.
    $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
  } while ($page->totalNumEntries > $selector->paging->startIndex);
  return $ret;
}

?>
