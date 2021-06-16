$(document).ready(function(){
 
//checkbox khu hoi
const checkboxDateTo = document.querySelector('.chk_date_to');
const containerDateTo = document.querySelectorAll('.container_date_to');

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


$('.btn-number').click(function(e){
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
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    

    $('.stopPropagation-dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
    
});



passengersCount();
$('#adult').change(passengersCount);
$('#children').change(passengersCount);
$('#infant').change(passengersCount);
function passengersCount(){
    var adults = $('#adult').val();
    var childrens = $('#children').val();
    var infants = $('#infant').val();
    var passengerInfo = adults + ' người lớn, ' + childrens + ' trẻ em, ' + infants + ' em bé.';
    $('#passenger_collapse').val(passengerInfo);
}


function addFlight(event){
    event.preventDefault();
    let urlFlight = $(this).data('url');
    $.ajax({
        type:"GET",
        url: urlFlight,
        dataType:'json',
        success: function($data){
            $.each(data, function () {
            $.each(this, function (index, value) {
                console.log(value);
                lastId = value.id; //Change lastId when we get responce from ajax
                $('#choosed_flight').append('' +
                '<span class="fa-stack text-primary">'+
                    '<span class="fa fa-circle-o fa-stack-2x"></span>'+
                    '<strong class="fa-stack-1x">'+
                        "{{count(session()->get('ticket'))}}"+    
                    "</strong>"+
                "</span>"+                                
                "<div>{{$item['aircraft_ID']}}</div>"+
                "<div>{{$item['start_time']}}</div>");

            });
        });
        },
        error: function(){

        }
    });
}

$('.add_flight').on('click', addFlight);

});