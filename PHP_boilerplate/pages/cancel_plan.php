<?php
$billingClass=new Billing($DBH);
	
if (isset($_POST['submit'])){
$billingClass->cancelSubscription($_SESSION['user_id']);
echo "Canceled<br/>";
echo "<a href='/' class='btn btn-success'>Continue</a>";
}	else {
	

?>

<form action="#" method="POST" id="cancelPlan" class="form-horizontal">
        
          <div class="form-actions fluid">
       

            
			  <div class="row row-centered">
			
			 	<fieldset>
				 	Are you sure you wish to cancel your subscription plan? Any special offers or coupons you may have had may no longer be eligible, and there is no way to undo this.
				 <div class="form-group">
			    
			    <div class="col-sm-6">
			      <button type="submit" name="submit" class="btn btn-danger">Yes, Please Cancel</button>
			    </div>
			  </div>
			  
			 	</fieldset>
			  </div>
          </div>
</form>
<?php } ?>