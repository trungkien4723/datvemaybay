$(document).ready(function(){
 
//checkbox khu hoi
const checkboxDateTo = document.querySelector('.chk_date_to');
const containerDateTo = document.querySelectorAll('.container_date_to');

$(containerDateTo).css("display","none");

checkboxDateTo.addEventListener('change',function(){

    if(containerDateTo){

        if($(this).is(":checked")){

            $(containerDateTo).css("display","block");
    
        }else{
    
            $(containerDateTo).css("display","none");    
    
        }

    }

});

});