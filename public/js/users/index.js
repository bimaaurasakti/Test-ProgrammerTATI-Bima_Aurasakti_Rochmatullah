$(document).ready(function(){

    let inputPassword = $('input[name=password]')
    let inputPasswordConfirmation = $('input[name=password_confirmation]')
    let inputManager = $('#input_manager_id')

    // Select2 initialization
    initAjaxSelect2(
        '#input_manager_id',
        `${base_url}/api/v1/select2/managers`,
        "Select Manager",
        {},
        function (params) {
            var query = {
                user_type: inputManager.data('type'),
                search: params.term,
                limit: 10,
                page: params.page || 1
            };
            return query;
        }
    )

    // Generate password
    $('.generate-new-password').click(function() {
        let newPassword = generateRandomString().toUpperCase()
        inputPassword.val(newPassword)
        inputPasswordConfirmation.val(newPassword)
    })

    // File upload
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

    function initAjaxSelect2(
        selector,
        url,
        placeholder = "Pilih Data",
        options = {},
        data = function (params) {
            var query = {
                search: params.term,
                limit: 10,
                page: params.page || 1
            };

            return query;
        }) {
        var config = options;
        config.theme = "bootstrap-5",
        config.placeholder = placeholder;
        config.ajax = {
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            delay: 250,
            processResults : function (data, params) {
                params.page = params.page || 1;

                return {
                    results: data.results,
                    pagination: {
                        more: (params.page * 10) < data.count_filtered
                    }
                };
            },
        };
        $(selector).select2(config);
    }
})
