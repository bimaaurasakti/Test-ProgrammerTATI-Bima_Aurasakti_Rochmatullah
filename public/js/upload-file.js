$(document).ready(function(){

    $(".button-trigger-hidden-input-file").click(function(){
        $(this).next('.file-upload').click();
    });

    $(".file-upload").change(function(){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).closest('.profile-img-edit').find('.profile-pic').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

})
