$(document).ready(function(){

    let form = $('#form_user')
    let inputRole = $('select[name=role_id]')
    let inputPassword = $('input[name=password]')
    let inputPasswordConfirmation = $('input[name=password_confirmation]')

    // Generate password
    $('.generate-new-password').click(function() {
        let newPassword = generateRandomString().toUpperCase()
        inputPassword.val(newPassword)
        inputPasswordConfirmation.val(newPassword)
    })

    $(".button-trigger-hidden-input-file").click(function(){
        $(this).next('.file-upload').click();
    });
    
    $(".file-upload").change(function(){
        readURL(this);
    });

    // On form submit
    form.submit(function(e) {
        inputRole.prop('disabled', false)
    })

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
