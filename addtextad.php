<?php 
include('header.php');
echo $c_id = $_GET['c_id']; 
$new = explode('#',$c_id);
$grpname = $new[1];
$adGroupId = $new[0];
if(@$_POST['submit']){

  $headline = $_POST['headline']; 
  $desc1 = $_POST['desc1']; 
  $desc2 = $_POST['desc2']; 
  $displayurl = $_POST['displayurl']; 
  $finalurl = $_POST['finalurl']; 

try {
    // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();
  // Log every SOAP XML request and response.
  $user->LogAll();
  // Run the example.
  AddTextAds($user,$adGroupId,$headline,$desc1,$desc2,$displayurl,$finalurl);
} catch (Exception $e) {
	
  printf("An error has occurred: %s\n", $e->getMessage());

}  } ?>

<form action="" method="post" >
<label>Ad Group Name</label> 
<input type="text" name="name" disabled value="<?Php echo $grpname; ?> "><br>
Create an ad
<label>Headline</label> 
<input type="text" name="headline" id="headline" value=""><br>
<label>description line 1</label> 
<input type="text" name="desc1" id="desc1" value=""><br>
<label>description line 2</label> 
<input type="text" name="desc2" id="desc2" value=""><br>
<label>Display URL</label> 
<input type="text" name="displayurl" id="displayurl" value="" placeholder="www.example.com"><br>
<label>Final URL</label> 
<input type="text" name="finalurl"  id="finalurl" value="" placeholder="http://www.example.com"><br>
<input type="submit" name="submit" value="submit"><br>
</form>

<div id="preview">
	<h2>Preview</h2>
	<div class='showheadline' id='showheadline'></div>
	<div class='showdesc1' id='showdesc1'></div>
	<div class='showdesc2' id='showdesc2'></div>
	<div class='showdisplayurl' id='showdisplayurl'></div>
	<div class='showfinalurl' id='showfinalurl'></div>
</div>

<script>
	var headlinebox = document.getElementById('headline');
	var desc1box = document.getElementById('desc1');
	var desc2box = document.getElementById('desc2');
	var displayurl = document.getElementById('displayurl');
	var finalurl = document.getElementById('finalurl');
  
	headlinebox.onkeyup = function(){
    	document.getElementById('showheadline').innerHTML = headlinebox.value;

	}
	desc1box.onkeyup = function(){
    	document.getElementById('showdesc1').innerHTML = desc1box.value;

	}
	desc2box.onkeyup = function(){
    	document.getElementById('showdesc2').innerHTML = desc2box.value;

	}
	displayurl.onkeyup = function(){
    	document.getElementById('showdisplayurl').innerHTML = displayurl.value;

	}
	finalurl.onkeyup = function(){
    	document.getElementById('showfinalurl').innerHTML = finalurl.value;

	}

</script>
<?php include('footer.php'); ?>


