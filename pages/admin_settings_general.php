<?php
	$groupClass=new Group($DBH);
	$groups=$groupClass->getGroups();
	$billingClass=new Billing($DBH);
	$plans=$billingClass->listPlans();
		?>
		
	
<form id="settingsForm" name="settingsForm" class="form-horizontal" action="#">
<section class="panel">
<h2>Profile Setup</h2>


<div class="control-group">
  <label class="control-label" for="domain">Site Domain</label>
  <div class="controls">
    <input id="domain" name="domain" type="text" placeholder="Domain" class="input-large" required="">
     <p class="help-block">Including http:// or https://</p>
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="admin_email">Master Email</label>
  <div class="controls">
    <input id="admin_email" name="admin_email" type="text" placeholder="Email" class="input-large">
    
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="default_permission">Default User Permission</label>
  <div class="controls">
	  
    <select id="default_permission" name="default_permission" class="input-large" >
    <?php foreach ($groups as $key){
		     ?> <option value="<?=$key['id'];?>"> <?=$key['title'];?></option>
		     <?}?>
    </select>
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="default_plan">Subscription to Begin on Registration</label>
  <div class="controls">
	  
    <select id="default_plan" name="default_plan" class="input-large" >
	    <option value=""> NONE</option>
    <?php foreach ($plans as $key){
		     ?> <option value="<?=$key['id'];?>"> <?=$key['name'];?></option>
		     <?}?>
    </select>
     <p class="help-block">If plan does not have free trial, user will be directed to billing after registration.</p>
  </div>
</div>




<div class="control-group">
  <label class="control-label" for="login_message">Need to Login Message</label>
  <div class="controls">                     
    <textarea id="login_message" name="login_message">Please log in to access this content.</textarea>
     <p class="help-block">For pages that a user must be logged in to see</p>
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="restricted_message">Restricted Message</label>
  <div class="controls">                     
    <textarea id="restricted_message" name="restricted_message">You do not have permission to access this content</textarea>
     <p class="help-block">For pages that a user does not have authority to see</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="terms_conditions">Registration Terms And Conditions</label>
  <div class="controls">                     
    <textarea id="terms_conditions" name="terms_conditions">You must be 15 years or older</textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="stripe_secret_key">Stripe Secret Key</label>
  <div class="controls">                     
     <input id="stripe_secret_key" name="stripe_secret_key" type="text" placeholder="Secret Key" class="input-large">
     <p class="help-block">Signup at <a href="http://www.stripe.com">Stripe.com</a></p>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="stripe_public_key">Stripe Public Key</label>
  <div class="controls">                     
     <input id="stripe_public_key" name="stripe_public_key" type="text" placeholder="Public Key" class="input-large">
     <p class="help-block">Signup at <a href="http://www.stripe.com">Stripe.com</a></p>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="Mandrill_key">Mandrill Key</label>
  <div class="controls">                     
     <input id="Mandrill_key" name="mandrill_key" type="text" placeholder="Mandrill Key" class="input-large">
     <p class="help-block">Signup at <a href="http://www.mandrill.com">Mandrill.com</a></p>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="public_profiles"></label>
  <div class="controls">
    <label class="checkbox" for="public_profiles">
      <input type="checkbox" name="public_profiles[]" id="public_profiles" value="1" >
      Allow profiles to be seen publicly?
    </label>
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="allow_register"></label>
  <div class="controls">
    <label class="checkbox" for="allow_register">
      <input type="checkbox" name="allow_register[]" id="allow_register" value='1'>
      Allow anyone to register?
    </label>
  </div>
</div>


<div class="buttons-wrap">
    <button class="btn btn-info">Cancel</button>
    <button class="btn btn-success" id="saveSettings">Update</button>
</div>


</section>
</form>

