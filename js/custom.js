$(document).ready(function(){
	$('a#delete_event').click(function(e){
	     var host = $(this).attr('href');
	      e.preventDefault();
            swal({title: "Are you sure?",   text: "This action is unrecoverable!",   
            type: "warning",   
            showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   
            closeOnConfirm: false }, function(confirm){  
                if(confirm){
                    window.location.href = host;
                }
                else return false; 
                }
            );
	});	
$("#datepicker").datepicker({dateFormat: 'yy-mm-dd',
                             changeMonth: true,
                             changeYear: true});
$("#datepicker2").datepicker({dateFormat: 'yy-mm-dd',
                             changeMonth: true,
                             changeYear: true});
$('form#resetpassform').submit(function(){
		var r = $('#r').val(),
			password = $('#password').val(),
			password_confirm = $('#password_confirm').val(),
            msg = "",
			errormsg = $('#errormsg');
		if(password != password_confirm){
			password = ''; password_confirm = '';			
            swal({   
                title: "Error!",text: 'Passwords do not match!',   
                type: "error",   
                confirmButtonText: "OK" 
                });
                password.focus();
		}
        else{
			errormsg.show();
			$.ajax({
			type : 'POST',
			dataType : 'json',
			data: {
				action: 'reset',
				r: r,
				p: encrypt(password),
				pc: encrypt(password_confirm)
			},
			url  : '../../login/query.php',
			success: function(responseText){
			 errormsg.hide();
             if(responseText.response != 'success'){
                password = ''; password_confirm = '';
				if(responseText.response == 'fail'){
					msg = 'All fields required.';
				}else if(responseText.response == 'fail_match'){
					msg = 'Passwords do not match.';
				}else if(responseText.response == 'fail_acclocked'){
					msg = 'Account locked out.';
				}else if(responseText.response == 'fail_verify'){
					msg = 'Account not verified.';
				}else if(responseText.response == 'fail_invalid'){
					msg = 'Invalid reset link.';
				}               
                else{
				    msg = 'Problem resetting password. Please try again.';
				}
                swal({   
                    title: "Error!",text: msg,   
                    type: "error",   
                    confirmButtonText: "OK" 
                    });
			    }
              else window.location.href = 'https://'+window.location.hostname;
             }
			});
		}
		return false;
	});
});