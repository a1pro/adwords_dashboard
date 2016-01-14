<?php

require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
 
$adwords_version ="v201509";

function GetCampaigns(AdWordsUser $user, $adwords_version) {

    // Get the service, which loads the required classes.
    $campaignService = $user->GetService('CampaignService', $adwords_version);

    // Create selector.
    $selector = new Selector();
    $selector->fields = array('Id', 'Name', 'Status');
    $selector->ordering[] = new OrderBy('Name', 'ASCENDING');

    // Filter out deleted criteria.
    $selector->predicates[] = new Predicate('Status', 'NOT_IN', array('REMOVED','PAUSED'));

    // Create paging controls.
    $selector->paging = new Paging(0, AdWordsConstants::RECOMMENDED_PAGE_SIZE);

    $ret = array();
    do {
        // Make the get request.
        $page = $campaignService->get($selector);

        // Display results.
        if (isset($page->entries)) {
            foreach ($page->entries as $campaign) {
                //printf("Campaign with name '%s' and id '%s' was found with Status: '%s'\n",
                // $campaign->name, $campaign->id, $campaign->status);
                $ret[] = array(
                    'name' => $campaign->name,
                    'id' => $campaign->id,
                    'active' => (strcmp($campaign->status,'ACTIVE')==0)?1:0
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

try {
  // Get AdWordsUser from credentials in "../auth.ini"
  // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();

  // Log every SOAP XML request and response.
  $user->LogAll();

  // Run the example.
  $all_campaign = GetCampaigns($user,$adwords_version); ?>
  <table border="2px"> 
  <tr>
      <td>Name</td>
      <td>Id</td>
      <td>Active</td>
      <td>Action</td>
  </tr>
<?php  foreach($all_campaign as $row){ ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['active']; ?></td>
        <td><a href="remove.php?id=<?php echo $row['id']; ?>">Delete</a>|<a href="updatecamp.php?id=<?php echo $row['id']; ?>">Update</a>|<a href="addtext.php?id=<?php echo $row['id']; ?>">Get Text Add</a>|<a href="adgroup.php?id=<?php echo $row['id']; ?>">Add ad Group</a>|<a href="group.php">Get ad Group</a></td>
    </tr>

<?php  } ?>

  </table>
  <?php
  
} catch (Exception $e) {
  printf("An error has occurred: %s\n", $e->getMessage());
}
        
?>