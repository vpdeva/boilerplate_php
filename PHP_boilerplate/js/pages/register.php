<script type="text/javascript">		
	$( document ).ready(function() {
$('#registerForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		submitHandler: function(validator, form, submitButton) {
            //console.log($('#registerForm').serialize());

                    event.preventDefault();
					
                    $.ajax({
                        url: "<?=SURL;?>methods.php?action=registerUser",
                        type: "post",
                        data: $('#registerForm').serialize() ,
                        success: function(d) {
	                         console.log(d);
	                        var json = JSON.parse(d);
	                       
	                        if (json.success==true){
                                   console.log(d, "");
                                    $.gritter.add({
						            title: 'Success!',
						            text: 'Please check your email for a confirmation link',
						            image: '',
						            sticky: true,
						            class_name: 'gritter-success'
									
						        });
								
								}
								else {
									$('.alert-danger').show();
									$('.payment-errors').text(json.message);
									
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
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        }
                    }
                },
                pword2: {
                    enabled: true,
                    validators: {
                        notEmpty: {
                            message: 'The confirm password is required and cannot be empty'
                        },
                        identical: {
                            field: 'pword',
                            message: 'The password and its confirm must be the same'
                        }
                    }
                }
			    }

});
});
</script>