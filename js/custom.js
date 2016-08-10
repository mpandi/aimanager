function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime()+(exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
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
$('form#forgotform').submit(function(){
		var email = $('input#email').val(),
            captchaResponse = $('#g-recaptcha-response').val(),
            msg = "",
			errormsg = $('#errormsg');
            if(captchaResponse == ''){
                swal({   
                    title: "Error!",text: "Captcha Field empty",   
                    type: "error",   
                    confirmButtonText: "OK" 
                });
                return false;
              }  
			errormsg.show();
			$.ajax({
			type : 'POST',
			dataType : 'json',
			data: {
				action: 'forgot',
				email: encrypt(email)
			},
			url  : '../../login/query.php',
			success: function(responseText){
			  errormsg.hide();
				 if(responseText.response == 'fail_captcha'){
					msg = "Captcha Mismatched!"; 
                swal({   
                    title: "Error!",text: msg,   
                    type: "error",   
                    confirmButtonText: "OK" 
                    });
                }
                else{
                    $('input#forgot').attr("disabled","disabled");
                    swal({   
                        title: "Success!",text: "Password reset email has been sent. Click the link in the email.",   
                        type: "success",   
                        confirmButtonText: "OK" 
                        });
				  }
			  }
            });
		return false;
	});
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