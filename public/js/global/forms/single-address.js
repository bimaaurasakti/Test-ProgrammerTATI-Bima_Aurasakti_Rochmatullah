$(document).ready(function(){

    const inputProvince = $('select[name=province_id]')
    const inputCity = $('select[name=city_id]')
    const inputDistrict = $('select[name=district_id]')
    const inputSubdistrict = $('select[name=subdistrict_id]')

    inputProvince.change(function() {
        resetTerritoryInputForm(inputCity)
        checkTerritoryInputForm($(this), inputCity)
    })

    inputCity.change(function() {
        resetTerritoryInputForm(inputDistrict)
        checkTerritoryInputForm($(this), inputDistrict)
    })

    inputDistrict.change(function() {
        resetTerritoryInputForm(inputSubdistrict)
        checkTerritoryInputForm($(this), inputSubdistrict)
    })

    // Select2 initialization
    initAjaxSelect2('#input_province_id', `${base_url}/api/v1/select2/provinces`, "Select Province")
    initAjaxSelect2('#input_city_id', `${base_url}/api/v1/select2/cities`, "Select City", {disabled: inputProvince.val() != null ? false : true}, function (params) {
        var query = {
            search: params.term,
            limit: 10,
            page: params.page || 1,
            province_id: inputProvince.val() || null
        };

        return query;
    })
    initAjaxSelect2('#input_district_id', `${base_url}/api/v1/select2/districts`, "Select District", {disabled: inputCity.val() != null ? false : true}, function (params) {
        var query = {
            search: params.term,
            limit: 10,
            page: params.page || 1,
            city_id: inputCity.val() || null
        };

        return query;
    })
    initAjaxSelect2('#input_subdistrict_id', `${base_url}/api/v1/select2/subdistricts`, "Select Subdistrict", {disabled: inputDistrict.val() != null ? false : true}, function (params) {
        var query = {
            search: params.term,
            limit: 10,
            page: params.page || 1,
            district_id: inputDistrict.val() || null
        };

        return query;
    })

    function resetTerritoryInputForm(nextFormInput) {
        nextFormInput.val(null)
        nextFormInput.trigger('change')
    }

    function checkTerritoryInputForm(currentFormInput, nextFormInput) {
        if(currentFormInput.val() != null) {
            nextFormInput.prop('disabled', false)
        } else {
            nextFormInput.prop('disabled', true)
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