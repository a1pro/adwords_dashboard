<?php
require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version = "v201509";
$id = $_GET['id']; 
$adGroupId = $id;

function GetTextAds(AdWordsUser $user, $adGroupId, $adwords_version) {
	//$adwords_version = "v201509";
    // Get the service, which loads the required classes.
    $adGroupAdService = $user->GetService('AdGroupAdService', $adwords_version);
  $days = "2";
    //print_r($adGroupAdService);
    // Create selector.
    $selector = new Selector();
    $selector->fields = array('Headline', 'Id', 'Description1', 'Description2', 'DisplayUrl', 'Url' , 'Status');
    //, 'AverageCpc', 'AveragePosition', 'Clicks', 'Conversions', 'Cost', 'Ctr', 'Impressions');
    $selector->ordering[] = new OrderBy('Headline', 'ASCENDING');

    // Create predicates.
    $selector->predicates[] = new Predicate('AdGroupId', 'IN', array($adGroupId));
    $selector->predicates[] = new Predicate('AdType', 'IN', array('TEXT_AD'));
    // By default disabled ads aren't returned by the selector. To return them
    // include the DISABLED status in a predicate.
    $selector->predicates[] = new Predicate('Status', 'NOT_IN', array('DISABLED', 'PAUSED'));
    //$selector->predicates[] = new Predicate('Impressions', 'GREATER_THAN', array('1'));
    $dateRange = new DateRange();
    $str1 = '-1 days';
    $str2 = '-1 days';
    if($days > 0)
    {
        $str1 = '-'.$days.' days';
        $str2 = '-'.$days.' days';
    }
    $dateRange->min = date('Ymd', strtotime($str1));
    $dateRange->max = date('Ymd', strtotime($str2));
    $selector->dateRange = $dateRange;

    // Create paging controls.
    $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

    $ret = array();
    do {
        // Make the get request.
        $page = $adGroupAdService->get($selector);
 
  
        // Display results.
        if (isset($page->entries)) {
            foreach ($page->entries as $adGroupAd) {
                $cr = 0;
                //if($adGroupAd->stats->clicks > 0)
                 //   $cr = $adGroupAd->stats->conversions / $adGroupAd->stats->clicks;

                $ret[] = array(
                    'headline' => $adGroupAd->ad->headline,
                    'id' => $adGroupAd->ad->id,
                    'textrow1' => $adGroupAd->ad->description1,
                    'textrow2' => $adGroupAd->ad->description2,
                    'view_url' => $adGroupAd->ad->displayUrl,
                    'target_url' => $adGroupAd->ad->url,
                    'active' => (strcmp($adGroupAd->status,'ENABLED')==0)?1:0
                  //  'clicks' => $adGroupAd->stats->clicks,
                  //  'cpc' => $adGroupAd->stats->averageCpc->microAmount / 1000000,
                  //  'conversions' => $adGroupAd->stats->conversions,
                  //  'cost' => $adGroupAd->stats->cost->microAmount / 1000000,
                  //  'ctr' => $adGroupAd->stats->ctr,
                   // 'impressions' => $adGroupAd->stats->impressions,
                   // 'cr' => $cr,
                    //'position' => $adGroupAd->stats->averagePosition
                );
                }
            }else{

            	echo "No textads are found";
            }

            // Advance the paging index.
            $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
        } while ($page->totalNumEntries > $selector->paging->startIndex);
        print_r($ret);
    return $ret;
    
} 

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  GetTextAds($user, $adGroupId,$adwords_version);
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
?>