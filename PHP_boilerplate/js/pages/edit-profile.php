<script type="text/javascript">
	
	
	$( document ).ready(function() {
$('#profileForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
            //console.log($('#registerForm').serialize());

                       event.preventDefault();
						//console.log($('#profileForm').serialize()+"&action=saveUser&token=<?=$_SESSION['token'];?>");
                    $.ajax({
                        url: "<?=SURL;?>methods.php?",
                        type: "post",
                        data: $('#profileForm').serialize()+"&action=saveUser&token=<?=$_SESSION['token'];?>" ,
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
								
								}
							}
                    });
    
        },
        fields: {
                     email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address'
                    },
					stringLength: {
                        min: 6,
                        max: 65,
                        message: 'The email must be more than 6 and less than 65 characters long'
                    }
                }
            },
             firstname: {
                validators: {
                    notEmpty: {
                        message: 'Your first name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 65,
                        message: 'First name must be more than 3 and less than 65 characters long'
                    }
                }
            },
            lastname: {
                validators: {
                    notEmpty: {
                        message: 'Your last name is required and can\'t be empty'
                    },
					stringLength: {
                        min: 3,
                        max: 65,
                        message: 'Last name must be more than 3 and less than 65 characters long'
                    }
                }
            },
            pword: {
                    enabled: true,
                    validators: {
                                            }
                },
                pword2: {
                    enabled: true,
                    validators: {
                        
                        identical: {
                            field: 'pword',
                            message: 'The password and its confirm must be the same'
                        }
                    }
                }
			    }

});
});



                
$( document ).ready(function() {
			
			
		  var form = $('#profileForm');
	  

  			var url='<?=SURL;?>methods.php?action=getUser&token=<?=$_SESSION['token'];?>&user_id=<?=issetor($_GET['pram1']);?>';
  			
  			
  			$.getJSON(url, 'data', process_response)
  			
function process_response(response) {
        
        var i;

            // for debug

        for (i in response.data) {
            form.find('[name="' + i + '"]').val(response.data[i]);
            //console.log(response.data[i]);
        }
        
        $("#groups").select2();


    }



});
	  
</script>