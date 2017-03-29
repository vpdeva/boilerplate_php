<?php
	if (isset($_SESSION['user_id']) && $userClass->userIsInGroup($_SESSION['user_id'], '1')==true){
		if (isset($_GET['pram1']))
			$user_id = $_GET['pram1'];
			else
			$user_id="";
	}
	else
	{
	$user_id=$_SESSION['user_id'];
	if (!isset($_GET['pram1']) || $_GET['pram1']!=$user_id )
		header("Location:/");
	}
	
	//does not route through the api for this
	$groupClass=new Group($DBH);
	$groups = $groupClass->getGroups();
	
	$userClass=new User($DBH);

?>
<form id="profileForm" name="profileForm">
<section class="panel">
<h2>Profile Setup</h2>

<div class="form-horizontal col-sm-6">
    <div class="form-group">
        <label class="control-label col-sm-4" for="name">First Name</label>
        <div class="col-sm-8 col-md-6">
            <input id="firstname" name="firstname" value="" class="form-control" placeholder="First Name">
        </div>
    </div>

    <!--<div class="form-group">
        <label class="control-label col-sm-4" for="username">Username</label>
        <div class="col-sm-8 col-md-6">
           <input id="username" name="username" value="" class="form-control" placeholder="Username">
        </div>
    </div>-->

</div>

<div class="form-horizontal form-widgets col-sm-6">
	  <div class="form-group">
        <label class="control-label col-sm-4" for="lastname">Last Name</label>
        <div class="col-sm-8 col-md-6">
            <input id="lastname" name="lastname" value="<?=issetor($profile['lastname']);?>" class="form-control" placeholder="Last Name">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="occupation">Email</label>
        <div class="col-sm-8 col-md-6">
            <input id="email" name="email" value="<?=issetor($profile['email']);?>" class="form-control" placeholder="Email">
        </div>
    </div>


</div>
<div class="clearfix"></div><hr>
<div class="clearfix"></div>
<div class="form-horizontal form-widgets col-sm-6">
	
    <div class="form-group">
        <label class="control-label col-sm-4" for="pword ">Change Password</label>
        <div class="col-sm-8 col-md-6">
            <input id="pword" name="pword" type="password" value="" class="form-control" placeholder="Password" style="display:inline-block">
        </div>
    </div>
</div>
<div class="form-horizontal form-widgets col-sm-6">
	
    <div class="form-group">
        <label class="control-label col-sm-4" for="pword2 ">Password Again</label>
        <div class="col-sm-8 col-md-6">
            <input id="pword2" value="" type="password" name="pword2" class="form-control" placeholder="Password Again" style="display:inline-block">
        </div>
    </div>
</div>


<div class="clearfix"></div>
<?php if (isset($_SESSION['user_id']) && $userClass->userIsInGroup($_SESSION['user_id'], '1')==true){?>
<hr>
<div class="clearfix"></div>

<div class="form-horizontal form-widgets col-sm-12">
<div class="form-horizontal form-widgets col-sm-6">
	
    <div class="form-group">
        <label class="control-label col-sm-4" for="status ">Change Status</label>
        <div class="col-sm-8 col-md-6">
            <select name="status" id="status">
	            <option value="0">Pending</option>
	            <option value="1">Confirmed</option>
			</select>
        </div>
    </div>
</div>
<div class="form-horizontal form-widgets col-sm-6">
	       <div class="form-group">
        <label class="control-label col-sm-4" for="groups">Groups</label>
        <div class="col-sm-8 col-md-6">
            <select multiple name="groups[]" id="groups" style="width:300px" class="populate">
	       <?php foreach ($groups as $key){
		     ?> <option value="<?=$key['id'];?>" <?php if ($userClass->userIsInGroup( $key['id'], $user_id)){ ?>selected="selected"<?}?> > <?=$key['title'];?></option>
		     <?}?>
			</select>
        </div>
    </div>
</div>

</div>
<?php } ?>

<input type="hidden" name="user_id" value="<?=$user_id;?>">
<div class="buttons-wrap">
  
    <button class="btn btn-success" type="submit" id="saveProfile">Update</button>
</div>
    
</section>
            
                  </form>  
