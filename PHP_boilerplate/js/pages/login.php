<script type="text/javascript">
$("#loginButton").on("click", function(event) {
	               
                    event.preventDefault();
			
						//console.log($('#loginForm').serialize());
                    $.ajax({
                        url: "<?=SURL;?>methods.php?",
                        type: "post",
                        data: $('#loginForm').serialize() ,
                        success: function(d) {
	                           //console.log(d, "");
	                        var json = JSON.parse(d);
	                        //console.log(json.success);
	                        if (json.success==true){
                                   //console.log(d, "");
                          
								window.location='<?=SURL;?>home';
								}
								else{
								$('#loginErrorMsg').removeClass('hide');
							
									
								}
							}
						
                    });
               
                    
                });
                </script>