<form action="adwords_dashboard.php" method="post" >
<label>Campaign Name</label> 
<input type="text" name="name" value=""><br>
<label>Advertising Channel Type</label>
<select name="advertisingChannelType">
    <option value="SEARCH"><?php echo $_GET['type']; ?></option><br>	
</select>
<input type="radio" name = "typeinfo" value="STANDARD">Standard<br>
<input type="radio" name = "typeinfo" value="FEATURE">All Features<br>
<label>Budget</label> 
<input type="text" name="budget" value=""><br> 
<label>Start Date</label>
<input type="text" name="startdate"  id="datepicker">
<label>End Date</label>
<input type="text" name="enddate" id="datepicker1">
<input type="submit" name="submit" value="submit"><br>
</form>
