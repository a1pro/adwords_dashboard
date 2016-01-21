<?php include('header.php'); 
?>
<body>  
<div class="addcamp"></div>
<?php 
if(@$_POST['submit']){

  $name = $_POST['name'];
  $channel = $_POST['advertisingChannelType'];
  $typeinfo = $_POST['typeinfo'];
  $budget = ($_POST['budget']*1000000);
  $startdate = $_POST['startdate'];
  $sdate = explode('/', $startdate);
  $stdate = $sdate[2].$sdate[0].$sdate[1];
  $enddate = $_POST['enddate'];
  $edate = explode('/', $enddate);
  $etdate = $edate[2].$edate[0].$edate[1];
  //echo $enddate = $_POST['enddate']; 

try {
   // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();
  // Log every SOAP XML request and response.
  $user->LogAll();
  // Run the example.
  AddCampaigns($user,$name,$channel,$typeinfo,$budget,$stdate,$etdate);
} catch (Exception $e) {
  echo "An error has occurred: %s\n", $e->getMessage();
} 

}

?>
	<!-- Dashboard Area Start -->
	<div class="col-md-12 dashboard_sec">
		<div class="panel panel-primary">
			<div class="panel-heading col-md-2">
				<h3>All campaigns</h3>
				<ul class="nav panel-tabs">
				<?php					

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
					  
					}catch(Exception $e) {
					 
					}
					       
					?>				
				</ul>
			</div>
			<div class="panel-body col-md-10">
				<div class="tab-content">
				    <div class="tab-pane abcdef active main_tab" id="tab">
					<input type="hidden" name="name" value=""/>
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#menu1">Campaigns</a></li>
							<li><a data-toggle="tab" href="#menu2">Ad Groups</a></li>
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
										<a data-toggle="dropdown" href="#">Add Campaign<span class="caret"></span></a>
										<ul role="menu" class="dropdown-menu">
											<li><a data-toggle="tab" href="#tab4default" class="get_type">Search And Display Networks</a></li>
											<li><a data-toggle="tab" href="#tab5default" class="get_type">Search Network with Display Select</a></li>
											<!--li><a data-toggle="tab" href="#tab6default" class="get_type">Search Network only</a></li>
											<li><a data-toggle="tab" href="#tab7default" class="get_type">Display Network only</a></li>
											<li><a data-toggle="tab" href="#tab8default" class="get_type">Shopping</a></li>
											<li><a data-toggle="tab" href="#tab9default" class="get_type">Video</a></li>
											<li><a data-toggle="tab" href="#tab10default" class="get_type">Universal app campaign</a></li-->

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


										<?php
											try {	
													  $user = new AdWordsUser();
													  $user->LogAll();	
													  $all_campaign = GetCampaigns($user,$adwords_version); 
													   foreach($all_campaign as $row){ ?>
													   	<li>
															<div class="item-checkbox">
																<input type="checkbox"/>
															</div>
															<div class="item-radio" >
																	<?php  if($row['active']=="ENABLED"){ ?>
																		<img src="abc.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="PAUSED"){ ?>
                                                               			<img src="paused.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="REMOVED"){ ?>
                                                               			<img src="remove.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php } ?>

                                                               		<ul style="display:none;background:white;border:1px gray solid" class="<?php echo $row['id']; ?>">

                                                           				<li class="stateval" value="enable"><a href="editcamp.php?value=_re&c_id=<?php echo $row['id']; ?>"><img src="abc.png">Enable</a></li>
                                                           				<li class="stateval" value="pause"><a href="editcamp.php?value=_rp&c_id=<?php echo $row['id']; ?>"><img src="paused.png">Pause</a></li>
                                                           				<li class="stateval" value="remove"><a href="editcamp.php?value=_rr&c_id=<?php echo $row['id']; ?>"><img src="remove.png">Remove</a></li>

                                                               		</ul>
																   <!--select name="chng_state" style="display:none" class="<?php echo $row['id']  ?>">	  	
																    	<option value="enabled"><img src="abc.png">Enable</option>
																    	<option value="paused"><img src="paused.png">Pause</option>
																    	<option value="removed"><img src="remove.png">Remove</option>
																    </select-->
															</div>
															<div class="item-cam">
																<span><?php echo $row['name']; ?></span>
															</div>
															<div class="item-budget">
																<span><?php echo "$".($row['budget']/1000000).".00"; ?></span>
															</div>
															<div class="item-status"> 
																<span>				
																		<?php
		                                                                if($row['active']=="ENABLED"){

		                                                                  	echo "Eligible"; 

		                                                                }else{

                                                                  		echo $row['active'];

                                                                  	}   ?></span>
															</div>
															<div class="item-cam-type">
																<span><?php

                                                                  if($row['campaigntype']=="SEARCH"){

                                                                  	echo "Search Network with Display Select";

                                                                  } ?>

																 </span>
															</div>
															<div class="item-cam-sub">
																<span>All Features
																<?php //echo $row['campaignsubtype']; ?>
																</span>
															</div>
															<div class="item-click">
																<span>Text</span>
															</div>
															<div class="item-impr">
																<span><?php echo $row['impressions']; ?></span>
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
																<span><?php echo $row['labels']; ?></span>
															</div>
														</li>				    

													<?php  } 													  
												}catch(Exception $e) {													 
												} ?>										
									</ul>
								</div>
							</div>
<!-- ///////////////////// Add ad groups start //////////////////////////////////////////////////////////////////-->
							<div id="menu2" class="tab-pane fade">
								
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
										<a data-toggle="dropdown" href="#" class="show_ad_grp">Add Ad Group<span class="caret"></span></a> 
										<div id="adgrp" style="display:none">
										<form action ="addadgrp.php" method="get"> 
											<p>Select a Campaign </p>
											<select name="c_id">
											<option value="">Select</option>
											<?php 
                                                
											   $all_campaign = GetCampaigns($user,$adwords_version); 

					   						   foreach($all_campaign as $row){ ?>
												<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
												<?php } ?>										
											</select></br>

											<input type ="submit" name="submit" value="Continue"> 
											</form>
											<form action="adwords_dashboard.php" method="post"> 
                                             <input type ="submit" name="cancel" value="Cancel"> 
                                             </form>
											<!--ul role="menu" class="dropdown-menu">
												<li><a data-toggle="tab" href="#tab4default" class="get_type">Search And Display Networks</a></li>
												
											</ul-->
										</div>
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
												<span>Ad Group</span>
											</div>
											<div class="item-budget">
												<span>Campaign name</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-lab">
												<span>Default Max. CPC</span>
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
										
											
										</li>


										<?php
											try {	
													  $user = new AdWordsUser();
													  $user->LogAll();	
													  $GetAdGroup = GetAdGroup($user,$adwords_version); 	
													  //print_r($$GetAdGroup);
													 // echo "chikooo";
													  foreach($GetAdGroup as $row){ 
                                                      // echo $row['campaignId'];
													  $GetadgrpCampaigns  = GetadgrpCampaigns($user, $adwords_version,$row['campaignId']);
													  //	print_r($GetadgrpCampaigns);
                                                           if($GetadgrpCampaigns != "no" ){

													   	?>
													   	<li>
															<div class="item-checkbox">
																<input type="checkbox"/>
															</div>
															<div class="item-radio" >
																	<?php  if($row['active']=="ENABLED"){ ?>
																		<img src="abc.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="PAUSED"){ ?>
                                                               			<img src="paused.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="REMOVED"){ ?>
                                                               			<img src="remove.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php } ?>

                                                               		<ul style="display:none;background:white;border:1px gray solid" class="<?php echo $row['id']; ?>">

                                                           				<li class="stateval" value="enable"><a href="editgrp.php?value=_re&c_id=<?php echo $row['id']; ?>"><img src="abc.png">Enable</a></li>
                                                           				<li class="stateval" value="pause"><a href="editgrp.php?value=_rp&c_id=<?php echo $row['id']; ?>"><img src="paused.png">Pause</a></li>
                                                           				<li class="stateval" value="remove"><a href="editgrp.php?value=_rr&c_id=<?php echo $row['id']; ?>"><img src="remove.png">Remove</a></li>

                                                               		</ul>
																 
															</div>
															<div class="item-cam">
																<span><?php echo $row['name']; ?></span>
															</div>
															<div class="item-budget">
																<span><?php echo $row['campaignName']; ?></span>
															</div>
															<div class="item-status"> 
																<span>				
																		<?php
		                                                                if($row['active']=="ENABLED"){

		                                                                  	echo "Eligible"; 

		                                                                }else{

                                                                  		echo $row['active'];

                                                                  	}   ?></span>
															</div>
															<div class="item-lab">
																<span><?php echo "$".($row['cpc']/1000000).".00"; ?></span>
															</div>
															<div class="item-cam-type">
																<span><?php

                                                                  if($row['campaigntype']=="SEARCH"){

                                                                  	echo "Search Network with Display Select";

                                                                  } ?>

																 </span>
															</div>
															<div class="item-cam-sub">
																<span>All Features
																<?php //echo $row['campaignsubtype']; ?>
																</span>
															</div>
															<div class="item-click">
																<span>Text</span>
															</div>
															<div class="item-impr">
																<span><?php echo $row['impressions']; ?></span>
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
															
														</li>				    

													<?php  } }												  
												}catch(Exception $e) {													 
												} ?>										
									</ul>
								</div>
							</div>
							<div id="menu3" class="tab-pane fade">								
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
										<a data-toggle="dropdown" href="#" class="show_text_ad">Add Text Ads<span class="caret"></span></a> 
										<div id="textad" style="display:none">
										<form action ="addtextad.php" method="get"> 
											<p>Select a Ad Group </p>
											<select name="c_id">
											<option value="">Select</option>
											<?php 
                                                
											   $all_adgroup = GetAdGroup($user,$adwords_version); 

					   						   foreach($all_adgroup as $row){
					   						   	 $GetadgrpCampaigns  = GetadgrpCampaigns($user, $adwords_version,$row['campaignId']);
													  //	print_r($GetadgrpCampaigns);
                                                           if($GetadgrpCampaigns != "no" ){

					   						    ?>
												<option value="<?php echo $row['id']; ?><?php echo "#".$row['name']; ?>"><?php echo $row['name']; ?></option>												
												<?php } } ?>										
											</select></br>

											<input type ="submit" name="submit" value="Continue"> 
											</form>
											<form action="adwords_dashboard.php" method="post"> 
                                             <input type ="submit" name="cancel" value="Cancel"> 
                                             </form>
											<!--ul role="menu" class="dropdown-menu">
												<li><a data-toggle="tab" href="#tab4default" class="get_type">Search And Display Networks</a></li>
												
											</ul-->
										</div>
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
												<span>Ad Group</span>
											</div>
											<div class="item-budget">
												<span>Campaign name</span>
											</div>
											<div class="item-status">
												<span>Status</span>
											</div>
											<div class="item-lab">
												<span>Default Max. CPC</span>
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
										
											
										</li>


										<?php
											try {	
													  $user = new AdWordsUser();
													  $user->LogAll();	
													  $GetTextAds = GetTextAds($user, $adwords_version);
													  //print_r($$GetAdGroup);
													 // echo "chikooo";
													  foreach($GetTextAds as $row){ 
                                                    

													   	?>
													   	<li>
															<div class="item-checkbox">
																<input type="checkbox"/>
															</div>
															<div class="item-radio" >
																	<?php  if($row['active']=="ENABLED"){ ?>
																		<img src="abc.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="PAUSED"){ ?>
                                                               			<img src="paused.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php }elseif($row['active']=="REMOVED"){ ?>
                                                               			<img src="remove.png" class="showstate" id="<?php echo $row['id']  ?>">
                                                               		<?php } ?>

                                                               		<ul style="display:none;background:white;border:1px gray solid" class="<?php echo $row['id']; ?>">

                                                           				<li class="stateval" value="enable"><a href="editgrp.php?value=_re&c_id=<?php echo $row['id']; ?>"><img src="abc.png">Enable</a></li>
                                                           				<li class="stateval" value="pause"><a href="editgrp.php?value=_rp&c_id=<?php echo $row['id']; ?>"><img src="paused.png">Pause</a></li>
                                                           				<li class="stateval" value="remove"><a href="editgrp.php?value=_rr&c_id=<?php echo $row['id']; ?>"><img src="remove.png">Remove</a></li>

                                                               		</ul>
																 
															</div>
															<div class="item-cam">
																<span><?php echo $row['headline']; ?><br>
																<?php echo $row['description1']; ?><br>
																<?php echo $row['description2']; ?><br>
																<?php echo $row['displayUrl']; ?><br></span>
															</div>
															<div class="item-budget">
																<span><?php echo $row['campaignName']; ?></span>
															</div>
															<div class="item-status"> 
																<span>				
																		<?php
		                                                                if($row['active']=="ENABLED"){

		                                                                  	echo "Eligible"; 

		                                                                }else{

                                                                  		echo $row['active'];

                                                                  	}   ?></span>
															</div>
															<div class="item-lab">
																<span><?php echo "$".($row['cpc']/1000000).".00"; ?></span>
															</div>
															<div class="item-cam-type">
																<span><?php

                                                                  if($row['campaigntype']=="SEARCH"){

                                                                  	echo "Search Network with Display Select";

                                                                  } ?>

																 </span>
															</div>
															<div class="item-cam-sub">
																<span>All Features
																<?php //echo $row['campaignsubtype']; ?>
																</span>
															</div>
															<div class="item-click">
																<span>Text</span>
															</div>
															<div class="item-impr">
																<span><?php echo $row['impressions']; ?></span>
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
															
														</li>				    

													<?php  } 
													/* }		*/										  
												}catch(Exception $e) {													 
												} ?>										
									</ul>
								</div>
							</div>
							<div id="menu4" class="tab-pane fade">
								<h3>4</h3>
							</div>
						</div>
					</div>
					<div class="states-data"></div>
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
    <?php include('footer.php'); ?>
	
