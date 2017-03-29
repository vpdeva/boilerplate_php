    <?php restricted(1);
	    
	    if (isset($_SESSION['pg_name'])) $pg_name=$_SESSION['pg_name'];
    ?>
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li <?php if ($pg_name=="admin_settings_users" || $pg_name=="admin_settings_user"){?> class="active" <?php }?>><a href="/admin_settings_users">Users </a></li>
            <li <?php if ($pg_name=="admin_settings_groups" || $pg_name=="admin_settings_group"){?> class="active" <?php }?>><a href="/admin_settings_groups">User Groups</a></li>
             
            
          </ul>
          <ul class="nav nav-sidebar">
	        <li  <?php if ($pg_name=="admin_settings_general"){?> class="active" <?php }?>><a href="/admin_settings_general">General</a></li>
	        <li  <?php if ($pg_name=="admin_settings_permissions"){?> class="active" <?php }?>><a href="/admin_settings_permissions">Page Permissions</a></li>
            <!--<li  <?php if ($pg_name=="admin_settings_profiles"){?> class="active" <?php }?>><a href="/admin_settings_profiles">Profiles</a></li>-->
            <li  <?php if ($pg_name=="admin_settings_social"){?> class="active" <?php }?>><a href="/admin_settings_social">Social Login</a></li>
            <li  <?php if ($pg_name=="admin_settings_subscriptions"){?> class="active" <?php }?>><a href="/admin_settings_subscriptions">Subscription Plans</a></li>
          </ul>
                 </div>
        
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">