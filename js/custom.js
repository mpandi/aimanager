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
 $("form > select[name=filter]").change(function(){
    var value = $("form > select[name=filter]").val();
    if(value =='customer'){
        $("input#new_value").attr('placeholder','Enter Customer Name');
    }
    else if(value =='type'){
        $("input#new_value").attr('placeholder','Enter Service Type');
    }
    else if(value =='expired'){
        $("input#new_value").val('expired');
    }
 });
 $("form#searchForm").change(function(){
    var value = $("form > select[name=filter]").val();
    if(value == 'expired'){
        $("form#searchForm").submit();
    }
 });
});