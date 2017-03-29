<?php $groupClass=new Group ($DBH);
$groups= $groupClass->getGroups();?>

<form class="form-horizontal" id="planForm">
	<section class="panel">
<h2>Subscription Plan Setup</h2>

<div class="control-group">
  <label class="control-label" for="name"> Plan Title</label>
  <div class="controls">
    <input id="name" name="name" type="text" placeholder="Title" class="input-large" required="">
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="grouptitle">Plan ID</label>
  <div class="controls">
    <input id="title" name="new_plan_id" type="text" placeholder="ID" class="input-large" required="" <?php if (!empty($_GET['pram1'])) echo "readonly"; ?>>
    
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="interval">Interval</label>
  <div class="controls">
    <select id="interval" name="interval" id="interval" class="input-large" <?php if (!empty($_GET['pram1'])) echo "readonly disabled"; ?>>
	    <option value="day">Daily</option>
	    <option value="week">Week</option>
	    <option value="month">Month</option>
	    <option value="year">Year</option>
	    
	    
    </select>
    <p class="help-block"> </p>
  </div>
</div>


<div class="control-group">
  <label class="control-label" for="interval_count"># of Intervals</label>
  <div class="controls">
    <input id="interval_count" name="interval_count" type="text" placeholder="Number" class="input-large" required="" <?php if (!empty($_GET['pram1'])) echo "readonly"; ?>>
    <p class="help-block"># of intervals between billing cycles (i.e. for every 3 months, select [Monthly] above and type [3] here.)</p>
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="amount">Amount (USD)</label>
  <div class="controls">
    <input id="amount" name="amount" type="text" placeholder="Amount" class="input-large" required="" <?php if (!empty($_GET['pram1'])) echo "readonly"; ?>>
    
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="trial_period_days">Trial Period Days</label>
  <div class="controls">
    <input id="interval_count" name="trial_period_days" type="text" placeholder="Days" class="input-large" required="" <?php if (!empty($_GET['pram1'])) echo "readonly"; ?> >
    <p class="help-block"># of days a user can use the features for free.)</p>
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="group">Group To Activate On User</label>
  <div class="controls">
    <select id="group" name="group" id="group" class="input-large">
	    <?php 
		    foreach ($groups as $key){?>
	    <option value="<?=$key['id'];?>"><?=$key['title'];?></option>
		<?php } ?>
	    
    </select>
    <p class="help-block">When subscribing, the user will get access to this group.</p>
  </div>
</div>


<div class="control-group">
	<input type="hidden" name="plan_id" id="plan_id" value="<?=issetor($_GET['pram1'])?>">
	<input type="button" value="Save" class="btn btn-success" id="savePlan">
</div>



	</section>
</form>



<div class="clear"></div>
<?php if (!empty($_GET['pram1'])){?>
<legend>Group Users</legend>
<table id="group_table">
	<thead>
		<th>ID</th>
		<th>Username</th>
		<th>email</th>
	
	</thead>
</table>
<?php }?>