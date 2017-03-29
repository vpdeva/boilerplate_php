<?php

	$groupClass=new Group($DBH);
	$groups = $groupClass->getGroups();
	
	$userClass=new User($DBH);
	$billingClass=new Billing($DBH);
	
	

		
if(isset($_POST["cmd"])){
	$stripe_customer_id = $billingClass->getStripeCustomerId($_SESSION['user_id']);

  
	  $error = '';
	  $success = '';

  try {
	if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
      throw new Exception("Fill out all required fields.");
    if (!isset($_POST['stripeToken']))
      throw new Exception("The Stripe Token was not generated correctly");
	  
	 $billingArray=array();
	 $billingArray['card']=$_POST['stripeToken'];
	

	if(!empty($_REQUEST["package"])){
		$plans= $billingClass->listPlans($_REQUEST["package"]);
		
		$amount=$plans['amount']*100;
		$total = intval($amount);
		//changing plan
		$billingArray['plan']=$_REQUEST["package"];
		//get plan price and info
		//charge card
		$chargeArray=array();
		$chargeArray["amount"] = $total;
		
		$billingClass->updateBilling($stripe_customer_id,$billingArray);
		//$billingClass->createCharge($stripe_customer_id,$chargeArray);
		
	} else {
		//updating billing & dont charge card
		 $billingClass->updateBilling($stripe_customer_id,$billingArray);
	}
	  
   
	  $success = '<div class="alert alert-success">
                <strong>Success!</strong> Your payment was successful.
				</div>';
  }
  catch (Exception $e) {
	$error = '<div class="alert alert-danger">
			  <strong>Error!</strong> '.$e->getMessage().'
			  </div>';
  }

	

				$usrid	=	$_SESSION['user_id'];
	$_SESSION['message'] = "Subscriber Package Updated Successfully";
	$_SESSION['msg_type'] = "alert-success";
	//echo "<script>window.location='".SURL."view-subscriber-package-listing';</script>";
	
}

?>

<h2>Billing</h2>
<div class="row">
	<div class="col-lg-6">
		<table id="plans_table">
	</table>
	<br/>
	
	<?php 
		
		if ($billingClass->checkSubscription($_SESSION['user_id'])!=false){
		
	?><a href="/cancel_plan"  class="btn btn-danger">Cancel Subscription</a><?	
	}?>
	<br/>
	<div id="disclaimer"></div>
	</div>
	<div class="col-lg-6">
<!--begin form-->
 <section class="panel">
      <div class="panel-body">
      
 <div class="alert alert-danger" id="a_x200" style="display: none;"> <strong>Error!</strong> <span class="payment-errors"></span> </div>
			  <span class="payment-success">
			  <?= issetor($success) ?>
			  <?= issetor($error) ?>
			  </span>
			<div id="select-plan-msg">Please select a plan before entering payment information.<br/> <a href="#"  onclick="justUpdate()" id="just-update">I just need to update my billing</a></div>  
         <form action="" method="POST" id="payment-form" class="form-horizontal" style="display: none;">
        
          <div class="form-actions fluid">
       
             <!--begin checkout form-->
            
			  <div class="row row-centered">
			
				  
			    
				      This form generates a secure reference ID to your payment details. Only our bank knows your payment information. We do not store your card on our system.
			      
			
			 			  <fieldset>
			   
			  <!-- Form Name -->
			  <legend>Billing Details</legend>
			  
			    
			  <!-- Street -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">Street</label>
			    <div class="col-sm-6">
			      <input type="text" name="street" placeholder="Street" class="address form-control">
			    </div>
			  </div>
			  
			  <!-- City -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">City</label>
			    <div class="col-sm-6">
			      <input type="text" name="city" placeholder="City" class="city form-control">
			    </div>
			  </div>
			  
			  <!-- State -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">State</label>
			    <div class="col-sm-6">
			      <input type="text" name="state" maxlength="65" placeholder="State" class="state form-control">
			    </div>
			  </div>
			  
			  <!-- Postcal Code -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
			    <div class="col-sm-6">
			      <input type="text" name="zip" maxlength="9" placeholder="Postal Code" class="zip form-control">
			    </div>
			  </div>
			  
			  <!-- Country -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">Country</label>
			    <div class="col-sm-6"> 
			      <!--input type="text" name="country" placeholder="Country" class="country form-control"-->
			      <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country" data-flags="true" data-filter="true"> </div>
			    </div>
			  </div>
			  
			  <!-- Email -->
			  <div class="form-group">
			    <label class="col-sm-4 control-label" for="textinput">Email</label>
			    <div class="col-sm-6">
			      <input type="text" name="email" maxlength="65" placeholder="Email" class="email form-control">
			    </div>
			  </div>
			  
			  
			  <fieldset>
			    <legend>Card Details</legend>
			    
			    <!-- Card Holder Name -->
			    <div class="form-group">
			      <label class="col-sm-4 control-label"  for="textinput">Card Holder's Name</label>
			      <div class="col-sm-6">
			        <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name" class="card-holder-name form-control">
			      </div>
			    </div>
			    
			    <!-- Card Number -->
			    <div class="form-group">
			      <label class="col-sm-4 control-label" for="textinput">Card Number</label>
			      <div class="col-sm-6">
			        <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number" class="card-number form-control">
			      </div>
			    </div>
			    
			    <!-- Expiry-->
			    <div class="form-group">
			      <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
			      <div class="col-sm-6">
			        <div class="form-inline">
			          <select name="select2" data-stripe="exp-month" class="card-expiry-month stripe-sensitive required form-control">
			            <option value="01" selected="selected">01</option>
			            <option value="02">02</option>
			            <option value="03">03</option>
			            <option value="04">04</option>
			            <option value="05">05</option>
			            <option value="06">06</option>
			            <option value="07">07</option>
			            <option value="08">08</option>
			            <option value="09">09</option>
			            <option value="10">10</option>
			            <option value="11">11</option>
			            <option value="12">12</option>
			          </select>
			          <span> / </span>
			          <select name="select2" data-stripe="exp-year" class="card-expiry-year stripe-sensitive required form-control">
			          </select>
			          <script type="text/javascript">
			            var select = $(".card-expiry-year"),
			            year = new Date().getFullYear();
			 
			            for (var i = 0; i < 12; i++) {
			                select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
			            }
			        </script> 
			        </div>
			      </div>
			    </div>
			    
			    <!-- CVV -->
			    <div class="form-group">
			      <label class="col-sm-4 control-label" for="textinput">CVV/CVV2</label>
			      <div class="col-sm-3">
			        <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
			      </div>
			    </div>
			    
			    <!-- Important notice -->
			    <div class="form-group">
			    <div class="panel panel-success">
			      <div class="panel-heading">
			        <h3 class="panel-title">Important notice</h3>
			      </div>
			      <div class="panel-body">
			        <p>Your card will be charged after submit.</p>
			       
			      </div>
			    </div>
			    
			    <!-- Submit -->
			    <div class="control-group">
			      <div class="controls">
			        <center>
			          <button class="btn btn-success" type="submit">Update Billing</button> &nbsp;<button type="button" class="btn default" onClick="javascript: history.go(-1);" >Cancel</button>
			        </center>
			      </div>
			    </div>
			  </fieldset>
             <!--end checkout form-->
                <input type="hidden" name="pkg_amount" id="pkg_amount"  value="" />
              <input type="hidden" name="package" id="package" value="" />
              <input type="hidden" name="cmd" value="edit" />
              
            </div>
			    </fieldset>
			    </fieldset>
			   
          </div>
          </div>
        </form>
        
      	
      </div>
    
</section>
<!--end form--> 
	</div>
    

            
                  