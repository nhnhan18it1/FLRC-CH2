$(document).ready(function () {
    var x=false;
    var y=false;
    $(':input[type="submit"]').prop('disabled', true);
     $('input[type="text"]').keyup(function() {
        if($('#us').val() != ''  ) {
          
            $(':input[type="submit"]').prop('disabled', false);
           
            
           
        }
     });
    
   
    //     if($('#us').val()!=''&& $('#ps').val()!=''){
    //        //$('#btnDangKi').attr('disabled', 'false');
    //        $('#btnDangKi').removeAttr('disabled');
    //    }
    //    else {
    //       $('#btnDangKi').addClass('disabled');
    //    }
    
   
    
    
    
   
});