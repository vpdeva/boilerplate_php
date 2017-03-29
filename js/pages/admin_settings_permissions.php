
<script type="text/javascript">
$( document ).ready(function() {
	
	$(".permission_group").select2();
	
	
	  var form = $('#permissionsForm');
	  
	  
	  $('#savePermissions').click(function() {
		       event.preventDefault();
							//console.log($(form).serialize()+"&action=savePermissions&token=<?=$_SESSION['token'];?>");
                    $.ajax({
                        url: "<?=SURL;?>methods.php?",
                        type: "post",
                        data: $(form).serialize()+"&action=savePermissions&token=<?=$_SESSION['token'];?>" ,
                        success: function(d) {
	                      //console.log(d);
	                       var json = JSON.parse(d);
	                        //console.log(json.success);
	                        if (json.success==true){
                                   console.log(d, "");
                                    $.gritter.add({
						            title: 'Profile Saved!',
						            text: '',
						            image: '',
						            sticky: false,
						            time: '1000',
						            class_name: 'gritter-success'
									
						        });
								//window.location='/admin_settings_users';
								}
							}
                    });  			
                  }); 
 




        
      });    
    </script>

