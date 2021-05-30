$(document).ready(function(){
    
    const imageInput = document.querySelector('.image_input');
    const imagePreviewContainer = document.querySelector('.image_preview_container');
    const imagePreview = document.querySelector('.image_preview');
    const imageInputClear = document.querySelector('.image_input_clear');
if(imageInput)
{
    imageInput.addEventListener('change', function(){
        const file = this.files[0];
        
        if(file){
            const reader = new FileReader();

            imagePreview.style.display = "block";

            reader.addEventListener("load",function(){
                console.log(this);
                imagePreview.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
            imageInputClear.classList.remove("disabled");
        }
    });
}

if(imageInputClear)
{
    imageInputClear.addEventListener("click", function(){
        imageInput.value = null;
        imagePreview.src = "http://localhost:8000" + "/images/user/Sample_User_Icon.png";
        imageInputClear.classList.add("disabled");
    });
}

});