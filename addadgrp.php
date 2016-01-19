<?php 
include('header.php');
$campaignId = $_GET['c_id'];
if(@$_POST['submit']){

  $name = $_POST['name']; 
  $amount = $_POST['amount']; 

try {
    // relative to the AdWordsUser.php file's directory.
  $user = new AdWordsUser();
  // Log every SOAP XML request and response.
  $user->LogAll();
  // Run the example.
  AddAdGroups($user,$campaignId,$name,$amount);
  echo "AdGroup has added";
} catch (Exception $e) {

  printf("An error has occurred: %s\n", $e->getMessage());

}  } ?>
<form action="" method="post" >
<label>Name</label> 
<input type="text" name="name" value=""><br>
<label>Bid Amount</label> 
<input type="text" name="amount" value=""><br>
<input type="submit" name="submit" value="submit"><br>
</form>


<?php include('footer.php'); ?>


