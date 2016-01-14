<?php require_once 'lib/Google/Api/Ads/AdWords/Lib/AdWordsUser.php';
	  $adwords_version ="v201509"; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Google Adwords</title>

		<!-- Css Start -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/custom.css" rel="stylesheet">
		<link href="fonts/calibri/stylesheet.css" rel="stylesheet">	
		<script>          
	        	function openTab(id){	 
	                $('.main-tab').click(function(){
					 var a =  'tab'+$(this).val();
					  $('.abcdef').attr('id',a);
					  $("input[name='name']").val(id);					  
					  $.ajax({
					  		url: "getcampaign.php?_cid="+$(this).val(),
                            type: "POST",
                            data : {},
							success: function(data, textStatus, jqXHR)
								{
									//data - response from server
									
									$(".states-data").html(data);
									//$("div:last").hide();
								
								},
							error: function (jqXHR, textStatus, errorThrown)
								{
								}

					  });
					});
			  	}		

		</script>
	</head>
<body>  
	<!-- Dashboard Area Start -->
	<div class="col-md-12 dashboard_sec">
		<div class="panel panel-primary">
			<div class="panel-heading col-md-2">
				<h3>All campaigns</h3>
				<ul class="nav panel-tabs">
				<?php	

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
					  $all_campaign = GetCampaigns($user,$adwords_version); 
					   foreach($all_campaign as $row){ ?>

					    <li class="main-tab" value="<?php echo $row['id']; ?>">
						<a  class="active" href="#tab<?php echo $row['id']; ?>" onclick="openTab(<?php echo $row['id']; ?>)"  data-toggle="tab"><?php echo $row['name']; ?></a>
					   </li>				    

					<?php  } 
					  
					} catch(Exception $e) {
					 
					}
					       
					?>				
				</ul>
			</div>
			<div class="panel-body col-md-10">
				<div class="tab-content">
				<div class="states-data"></div>
					<div class="tab-pane abcdef active" id="tab">
					<input type="hidden" name="name" value=""/>
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu1">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu2">Settings</a></li>
							<li><a data-toggle="tab" href="#menu3">Ads</a></li>
							<li><a data-toggle="tab" href="#menu4">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu1" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign<?php echo $row['id']; ?></span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio2">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio3">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio4">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio5">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu2" class="tab-pane fade">
								<h3>2</h3>
							</div>
							<div id="menu3" class="tab-pane fade">
								<h3>3</h3>
							</div>
							<div id="menu4" class="tab-pane fade">
								<h3>4</h3>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab2">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu5">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu6">Settings</a></li>
							<li><a data-toggle="tab" href="#menu7">Ads</a></li>
							<li><a data-toggle="tab" href="#menu8">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu5" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign</span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio4">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio5">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu6" class="tab-pane fade">
								<h3>5</h3>
							</div>
							<div id="menu7" class="tab-pane fade">
								<h3>6</h3>
							</div>
							<div id="menu8" class="tab-pane fade">
								<h3>7</h3>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab3">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu9">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu10">Settings</a></li>
							<li><a data-toggle="tab" href="#menu11">Ads</a></li>
							<li><a data-toggle="tab" href="#menu12">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu9" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign</span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu10" class="tab-pane fade">
								<h3>10</h3>
							</div>
							<div id="menu11" class="tab-pane fade">
								<h3>11</h3>
							</div>
							<div id="menu12" class="tab-pane fade">
								<h3>12</h3>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab4">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu13">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu14">Settings</a></li>
							<li><a data-toggle="tab" href="#menu15">Ads</a></li>
							<li><a data-toggle="tab" href="#menu16">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu13" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign</span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio5">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu14" class="tab-pane fade">
								<h3>14</h3>
							</div>
							<div id="menu15" class="tab-pane fade">
								<h3>15</h3>
							</div>
							<div id="menu16" class="tab-pane fade">
								<h3>16</h3>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab5">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu17">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu18">Settings</a></li>
							<li><a data-toggle="tab" href="#menu19">Ads</a></li>
							<li><a data-toggle="tab" href="#menu20">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu17" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign</span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu18" class="tab-pane fade">
								<h3>18</h3>
							</div>
							<div id="menu19" class="tab-pane fade">
								<h3>19</h3>
							</div>
							<div id="menu20" class="tab-pane fade">
								<h3>20</h3>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="tab6">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu21">Ad groups</a></li>
							<li><a data-toggle="tab" href="#menu22">Settings</a></li>
							<li><a data-toggle="tab" href="#menu23">Ads</a></li>
							<li><a data-toggle="tab" href="#menu24">Keywords</a></li>
						</ul>
						<div class="tab-content cus-cont">
							<div id="menu21" class="tab-pane fade in active">
								<ul class="nav nav-tabs">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">All but removed ad groups<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Segment<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Filter<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Columns<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav nav-tabs cus-drop-down">
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Edit<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Details<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Bid strategy<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a data-toggle="dropdown" href="#">Automate<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default">Default 4</a></li>
											<li><a data-toggle="tab" href="#tab5default">Default 5</a></li>
										</ul>
									</li>
								</ul>
								<div class="cus-add-items">
									<ul>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio1">
											</div>
											<div class="item-cam">
												<span>Campaign</span>
											</div>
											<div class="item-budget">
												<span>Budget</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-cam-type">
												<span>Campaign type</span>
											</div>
											<div class="item-cam-sub">
												<span>Campaign subtype</span>
											</div>
											<div class="item-click">
												<span>Clicks</span>
											</div>
											<div class="item-impr">
												<span>Impr.</span>
											</div>
											<div class="item-ctr">
												<span>CTR</span>
											</div>
											<div class="item-avg">
												<span>Avg. CPC</span>
											</div>
											<div class="item-cost">
												<span>Cost</span>
											</div>
											<div class="item-pos">
												<span>Avg. Pos.</span>
											</div>
											<div class="item-lab">
												<span>Labels</span>
											</div>
										</li>
										<li>
											<div class="item-checkbox">
												<input type="checkbox"/>
											</div>
											<div class="item-radio">
												<input type="radio" name="button" value="item-radio5">
											</div>
											<div class="item-cam">
												<span>Text</span>
											</div>
											<div class="item-budget">
												<span>Text Text Text</span>
											</div>
											<div class="item-status">
												<span>Text</span>
											</div>
											<div class="item-cam-type">
												<span>Text</span>
											</div>
											<div class="item-cam-sub">
												<span>Text</span>
											</div>
											<div class="item-click">
												<span>Text</span>
											</div>
											<div class="item-impr">
												<span>Text</span>
											</div>
											<div class="item-ctr">
												<span>Text</span>
											</div>
											<div class="item-avg">
												<span>Text</span>
											</div>
											<div class="item-cost">
												<span>Text</span>
											</div>
											<div class="item-pos">
												<span>Text</span>
											</div>
											<div class="item-lab">
												<span>Text</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div id="menu22" class="tab-pane fade">
								<h3>22</h3>
							</div>
							<div id="menu23" class="tab-pane fade">
								<h3>23</h3>
							</div>
							<div id="menu24" class="tab-pane fade">
								<h3>24</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	
	<!-- Jquery Start Here -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Tab Jquery Starts -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.main-tab').click(function(){ 
				$('.main-tab').children("ul.inner-tab").hide();
				$(this).children("ul.inner-tab").show();
			});
		 });
	</script>
</body>
</html>