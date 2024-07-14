$(document).ready(function(){

    // Select2 initialization
    initAjaxSelect2(
        '#input_user_id',
        `${base_url}/api/v1/select2/users`,
        "Select User",
        {},
        function (params) {
            var query = {
                search: params.term,
                limit: 10,
                page: params.page || 1
            };
            return query;
        }
    )

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
