$(document).ready(function(){
    const imageInput = document.getElementById('image_input');
    const imagePreviewContainer = document.getElementById('image_preview_container');
    const imagePreview = document.getElementById('image_preview');

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
    }
    else
    {
        imagePreview.style.display = null;
        imagePreview.setAttribute("src", "{{asset('/images/user/Sample_User_Icon.png')}}");        
    }
});
});

