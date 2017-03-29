<?php $genClass=new General($DBH);
	$socials=$genClass->getSocialSettings();
		?>
<form id="settingsForm" name="settingsForm" class="" action="#">
<section class="panel">
<h2>Social Login Setup</h2>

<?php foreach ($socials as $social) {?>
<fieldset>
 <legend><?=$social['provider'];?></legend>
<div class="control-group">

  <div class="controls">
    <label class="checkbox control-label" for="<?=$social['provider'];?>_active">
      <input type="checkbox" name="<?=$social['provider'];?>_active[]" id="<?=$social['provider'];?>_active" value="1" <?php if ($social['status']==1)echo "checked"; ?> >
      <?=$social['provider'];?> Activated
    </label>
  </div>
</div>






	
		<div class="control-group">
		<label class="control-label" for="<?=$social['provider'];?>_id">ID</label>
		<div class="controls">
		<input id="<?=$social['provider'];?>_id" name="<?=$social['provider'];?>_id" type="text" placeholder="<?=$social['provider'];?> ID" class="input-large" required="" value="<?php echo issetor($social['id_key']);?>">
    
  	</div>


</div>

			<div class="control-group">
		<label class="control-label" for="<?=$social['provider'];?>_sk">Secret Key</label>
		<div class="controls">
		<input id="<?=$social['provider'];?>_sk" name="<?=$social['provider'];?>_sk" type="text" placeholder="<?=$social['provider'];?> Secret Key" class="input-large" required="" value="<?php echo issetor($social['secret_key']);?>">
    
  		</div>
	</div>

	
		
</fieldset>
<div class="clear"></div>
<?}?>

<div class="buttons-wrap">
    <button class="button">Cancel</button>
    <button class="button" id="saveSettings">Update</button>
</div>


</section>
</form>