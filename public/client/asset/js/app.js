$(document).ready(function(){
 
//checkbox khu hoi
const checkboxDateTo = document.body.querySelector('.chk_date_to');
const containerDateTo = document.body.querySelectorAll('.container_date_to');

$(containerDateTo).css("display","none");

if(checkboxDateTo)
{
    checkboxDateTo.addEventListener('change',function(){

        if(containerDateTo){
    
            if($(this).is(":checked")){
    
                $(containerDateTo).css("display","block");
        
            }else{
        
                $(containerDateTo).css("display","none");    
        
            }
    
        }
    
    });
}


$('body').on('click','.btn-number',function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('body').on('focusin','.input-number',function(){
   $(this).data('oldValue', $(this).val());
});
$('body').on('change','.input-number',function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        //alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        //alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    } 
});
$('body').on('click','.stopPropagation-dropdown-menu',function(e) {
        e.stopPropagation();
    });


passengersCount();
$(document).on('change','#adult',passengersCount);
$(document).on('change','#children',passengersCount);
$(document).on('change','#infant',passengersCount);
function passengersCount(){
    var adults = $('#adult').val();
    var childrens = $('#children').val();
    var infants = $('#infant').val();
    var passengerInfo = adults + ' người lớn, ' + childrens + ' trẻ em, ' + infants + ' em bé.';
    $('#passenger_collapse').val(passengerInfo);
}


$(document).on('click','.add_flight',function(e){
    e.preventDefault();
    let url = $(this).data('url');
    $.ajax({
        type:'GET',
        url:url,
        dataType:'json',
        success:function(data){
            console.log(data);
            if(data.code === 200){
                $('.booking_list').html(data.component);
            }
        },
        error: function(xhr){
            var err = xhr.responseText;
            alert(err.error);
        }
    });
});


$(document).on('click','.change_flight',function(e){
    e.preventDefault();
    let url = $(this).data('url');
    $.ajax({
        type:'GET',
        url:url,
        dataType:'json',
        success:function(data){
            console.log(data);
            if(data.code === 200){
                $('.booking_list').html(data.component);
            }
        },
        error: function(xhr){
            var err = xhr.responseText;
            alert(err.error);
        }
    });
});


});