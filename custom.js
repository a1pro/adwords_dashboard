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
									$(".main_tab").hide();
																	
								},
							error: function (jqXHR, textStatus, errorThrown)
								{
								}

					  });
					});
			  	}
				$(function(){

				  	$('.get_type').click(function () {
	                 	var type = $(this).text();
	                 	//alert(type);
	                 	$.ajax({ 
	                 		url:"addcampaign.php?type="+type,
	                 		type:"POST",
	                 		data:{},
	                 		success: function(data, textStatus, jqXHR){
	                 				//alert(data);
	                 				$(".addcamp").html(data);	                 				
	                 		},
	                 		error: function(jqXHR, textStatus, errorThrown){
	                 		}
	                 	});

	    			});
    			});
    		
