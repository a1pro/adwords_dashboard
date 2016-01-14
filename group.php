<?php 

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version ="v201509";

function GetAdGroup(AdWordsUser $user, $adwords_version) {
    // Get the service, which loads the required classes.
    $adgroupService = $user->GetService('AdGroupService', $adwords_version);

    // Create selector.
    $selector = new Selector();
    $selector->fields = array('Id', 'Name', 'CampaignId', 'Status');
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
                    'active' => (strcmp($adgroup->status,'ENABLED')==0)?1:0
                );
            }
        } else {
            //print "No adgroups were found.\n";
        }
        // Advance the paging index.
        $selector->paging->startIndex += AdWordsConstants::RECOMMENDED_PAGE_SIZE;
    } while ($page->totalNumEntries > $selector->paging->startIndex);   
      
    return $ret;
}


try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll(); 

  // Run the example.
  $GetAdGroup = GetAdGroup($user,$adwords_version); ?>
    <table border="2px"> 
  <tr>
      <td>Name</td>
      <td>Id</td>
      <td>Active</td>
      <td>Action</td>
  </tr>
<?php
  foreach($GetAdGroup as $row){ ?>

      <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['active']; ?></td>
        <td><a href="remove.php?adgrp_id=<?php echo $row['id']; ?>">Delete</a>|<a href="updatecamp.php?adgrp_id=<?php echo $row['id']; ?>">Update</a>|<a href="addtext.php?adgrp_id=<?php echo $row['id']; ?>">Get Text Add</a>|<a href="addkeywords.php?adgrp_id=<?php echo $row['id']; ?>">Add keywords</a>|<a href="">Get keyword</a></td>
    </tr>
   <?php
  }  
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}


?>