<?php include('header.php'); ?>
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

  AddCampaigns($user,$name,$channel,$typeinfo,$budget,$stdate,$etdate);

} ?>
	<!-- Dashboard Area Start -->
	<div class="col-md-12 dashboard_sec">
		<div class="panel panel-primary">
			<div class="panel-heading col-md-2">
				<h3>All campaigns</h3>
				<ul class="nav panel-tabs">
				<?php
					  $all_campaign = GetCampaigns($user,$adwords_version); 
					   foreach($all_campaign as $row){ ?>

					    <li class="main-tab" value="<?php echo $row['id']; ?>">
						<a  class="active" href="#tab<?php echo $row['id']; ?>" onclick="openTab(<?php echo $row['id']; ?>)"  data-toggle="tab"><?php echo $row['name']; ?></a>
					   </li>				    

					<?php  }  ?>				
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

													<?php  } ?>										
									</ul>
								</div>
							</div>
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
										<a data-toggle="dropdown" href="#" class="show_ad_grp">Add Ad Group<span class="caret"></span>
									    </a> 
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
													</select>

													<input type ="submit" name="submit" value="Continue"/> 
											</form>
											<form action="adwords_dashboard.php" method="post"> 
                                            	 <input type ="submit" name="cancel" value="Cancel"> 
                                             </form>
										
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
										 $GetAdGroup = GetAdGroup($user,$adwords_version); 	
										
													  foreach($GetAdGroup as $row){ 

													   	?>
													   	<li>
															<div class="item-checkbox">
																<input type="checkbox"/>
															</div>
															<div class="item-radio" >
																<input type="checkbox"/>	
																 
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

											<?php  } ?>										
									</ul>
								</div>
							</div>
							<div id="menu3" class="tab-pane fade">								
							<h2>menu3333</h2>
							</div>
							<div id="menu4" class="tab-pane fade">
															
								<h2>menu4443</h2>
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
    
	<!-- Tab Jquery Starts -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.main-tab').click(function(){ 
				$('.main-tab').children("ul.inner-tab").hide();
				$(this).children("ul.inner-tab").show();
			});

			$(".showstate").click(function(){
				var id  = $(this).attr('id');
				$("."+id).toggle();					
       		});

       		$(".show_ad_grp").click(function(){
       				//alert("kfudgdf");
                    $("#adgrp").toggle();	
      		});     		

       		$(".show_text_ad").click(function(){
       				//alert("kfudgdf");
                    $("#textad").toggle();	
      		});
      		$(".show_keywords").click(function(){
       				//alert("kfudgdf");
                    $("#keywords").toggle();	
      		});


      		
		});
	</script>
</body>
</html>
	
