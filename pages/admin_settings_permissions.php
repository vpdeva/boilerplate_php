<?php  $groupClass=new Group($DBH);
	$generalClass=new General($DBH);
	$groups=$groupClass->getGroups();
	?>
<form id="permissionsForm" name="permissionsForm" action="#">
<section class="panel">
<h2>Permissions Setup</h2>
For public pages, leave boxes blank.<br/>
<?
if ($handle = opendir('pages')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != ".." && $entry != "login.php"  && $entry != "logout.php" && $entry != "page-not-found.php") {
		$item = preg_replace('/\.php$/','',$entry);
           ?>
           
		  <?=$item;?><br/>
           <select multiple name="permissions[<?=$item;?>][]" class="permission_group" id="<?=$item;?>" style="width:300px" class="populate">
	       <?php foreach ($groups as $key){
		     ?> <option value="<?=$key['id'];?>" <?php if ($generalClass->getPermissions( $item, $key['id'])){ ?>selected="selected"<?}?> > <?=$key['title'];?></option>
		     <?}?>
			</select><br/>
           
           
           <?
        }
    }

    closedir($handle);
}?>


<div class="buttons-wrap">
    <button class="btn btn-info">Cancel</button>
    <button class="btn btn-success" id="savePermissions">Update</button>
</div>


</section>
</form>