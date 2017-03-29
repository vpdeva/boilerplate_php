<form class="form-horizontal" id="groupForm">
	<section class="panel">
<h2>Group Setup</h2>






<div class="control-group">
  <label class="control-label" for="grouptitle">Group Title</label>
  <div class="controls">
    <input id="title" name="title" type="text" placeholder="Title" class="input-large" required="">
    
  </div>
</div>


<!--<div class="control-group">
  <label class="control-label" for="group_redirect">Redirect To</label>
  <div class="controls">
    <input id="group_redirect" name="redirect" id="redirect" type="text" placeholder="/pageforthisgroup" class="input-large">
    <p class="help-block">Specify the page you want members of this group to be directed to upon logging in. </p>
  </div>
</div>-->


<!--<div class="control-group">
  <label class="control-label" for="sendemail"></label>
  <div class="controls">
    <label class="checkbox" for="sendemail">
      <input type="checkbox" name="email" id="email" value="1" >
      Send email when joining group?
    </label>
  </div>
</div>-->

<div class="control-group">
	<input type="hidden" name="group_id" id="group_id" value="<?=issetor($_GET['pram1'])?>">
	<input type="button"  class="btn btn-success" value="Save" id="saveGroup">
</div>



	</section>
</form>



<div class="clear"></div>
<?php if (isset($_GET['pram1'])){?>
<legend>Group Users</legend>
<table id="group_table">
	<thead>
		<th>ID</th>
		<th>Username</th>
		<th>email</th>
	
	</thead>
</table>
<?php }?>