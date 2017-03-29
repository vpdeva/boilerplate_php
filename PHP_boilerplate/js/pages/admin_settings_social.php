
<script type="text/javascript">
$( document ).ready(function() {
	
	  var form = $('#settingsForm');
	  
	  
	  $('#saveSettings').click(function() {
		       event.preventDefault();
							console.log($(form).serialize()+"&action=saveSocialSettings&token=<?=$_SESSION['token'];?>");
                    $.ajax({
                        url: "<?=SURL;?>methods.php?",
                        type: "post",
                        data: $(form).serialize()+"&action=saveSocialSettings&token=<?=$_SESSION['token'];?>" ,
                        success: function(d) {
	                      console.log(d);
	                       var json = JSON.parse(d);
	                        //console.log(json.success);
	                        if (json.success==true){
                                   console.log(d, "");
                                    $.gritter.add({
						            title: 'Social Settings Saved!',
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
 
 
 /*var url='<?=SURL;?>methods.php?action=getSettings&token=<?=$_SESSION['token'];?>';
  			
  			
 $.getJSON(url, 'data', process_response)
  			
function process_response(response) {
        
        var i;

            // for debug

        for (i in response.data) {
	        console.log(i+":"+response.data[i]);
	        if (i=='public_profiles' && response.data[i]=='1')
	        $('#public_profiles' ).prop('checked', true);
	        else if (i=='allow_register' && response.data[i]=='1')
	        $('#allow_register' ).prop('checked', true);
			else {
	        
            form.find('[name="' + i + '"]').val(response.data[i]);
            
        	}
        }
    }*/



        
      });    
    </script>

