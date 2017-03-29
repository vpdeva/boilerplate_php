<script type="text/javascript">		
	$( document ).ready(function() {
$('#resetForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
		
        fields: {
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