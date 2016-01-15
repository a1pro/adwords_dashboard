<?php


function GetCampaigns(AdWordsUser $user, $adwords_version) {
					    // Get the service, which loads the required classes.
					    $campaignService = $user->GetService('CampaignService', $adwords_version);
					    // Create selector.					 
					    $selector = new Selector();
					    $selector->fields = array('Id', 'Name', 'Status' ,'Amount','AdvertisingChannelType','AdvertisingChannelSubType','Labels','BidCeiling','FrequencyCapMaxImpressions');
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
					                $ret[] = array(
					                    'name' => $campaign->name,
					                    'id' => $campaign->id,					                  
					                    'active' => $campaign->status,
					                    'budget' => $campaign->budget->amount->microAmount,
					                    'campaignsubtype'=>$campaign->advertisingChannelSubType,
					                    'campaigntype'=>$campaign->advertisingChannelType,
					                    'labels'=>$campaign->frequencyCap->impressions,
					                    'impressions' =>$campaign->labels

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
?>
