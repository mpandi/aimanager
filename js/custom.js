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
$("#datepicker3").datepicker({dateFormat: 'yy-mm-dd',
                             changeMonth: true,
                             changeYear: true});

});