$(document).ready(function(){
 $("form#searchForm_").change(function(){
    var new_value = $("form > select[name=filter]").val();
    if(new_value =='type'){
        $("input#new_value").attr('placeholder','Enter Service Type');
    }
    if(new_value =='customer'){
        $("input#new_value").attr('placeholder','Enter Customer Name');
    }
    else if(new_value == 'expired'){
        $("form#searchForm_").submit();
    }
 });
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