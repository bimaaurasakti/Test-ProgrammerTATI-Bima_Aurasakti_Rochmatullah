$(document).ready(function() {
    function appendNewDinamycOptionSelect2(element, postUrl, data) {
        $.ajax({
            url: postUrl,
            method: "POST",
            data: data,
            success: function (res) {
                var option = `<option value="${res.data.id}" selected>${res.data.text}</option>`;

                element.append(option);
                element.trigger('change');
                element.select2("close");
            },
            error: function (res) {
                console.log(res);
            }
        });
    }

    function addSelect2EventOpenListener(element, postUrl, key) {
        element.on('select2:open', function () {
            var data = {};
            $(document).on('keyup', '.select2-search__field', function(event) {
                var value = element.next().find('.select2-search__field').val();
                data = {
                    [key]: value
                };
                $(document).on('click', '.add-new-value-button',  function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    appendNewDinamycOptionSelect2(element, postUrl, data);
                    $('.select2-search__field').val('');
                });
                if (event.keyCode == 13) {
                    appendNewDinamycOptionSelect2(element, postUrl, data)
                    $('.select2-search__field').val('');
                }
            });
        });
    }

    function initAjaxSelect2(
        selector,
        url,
        placeholder,
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
        selector.select2(config);
    }

    function initManualSelect2(selector, placeholder, options = {}) {
        var config = options;
        config.theme = "bootstrap-5";
        config.placeholder = placeholder;
        selector.select2(config);
    }

    $('.form-switch .form-check-input').change(function () {
        var isChecked = $(this).prop('checked');
        var labelText = isChecked ? $(this).data('active-text') : $(this).data('inactive-text');
        $('.form-check-label').text(labelText);
    });

    $('.toggle-password-btn').click(function() {
        $(this).toggleClass('active');
        var input = $($(this).prev('.toggle-password'));
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            $(this).find('i').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
        } else {
            input.attr('type', 'password');
            $(this).find('i').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
        }
    });

    $('.select2').each(function() {
        var config = {};
        var ajaxUrl = $(this).data('ajax-url');
        var placeholder = "Pilih Data";
        config.width = '100%';
        if ($(this).is('[data-placeholder]')) {
            placeholder = $(this).data('placeholder');
        }
        if ($(this).is('[data-width]')) {
            config.width = $(this).data('width');
        }
        if ($(this).is('[data-dropdown-parent]')) {
            var dropdownParent = $(this).data('dropdown-parent');
            config.dropdownParent = $(`${dropdownParent}`);
        }
        if ($(this).is('[data-add-new-value-url]')) {
            var addNewValueUrl = $(this).data('add-new-value-url');
            config.language = {
                noResults: function () {
                    return `<a href='#' class='d-flex align-items-center add-new-value-button' style='gap:5px;'><svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg> Add</a>`;
                }
            }
            config.escapeMarkup = function (markup) { return markup; };
        }

        // Menggunakan data manual jika tidak ada ajaxUrl
        if (ajaxUrl) {
            initAjaxSelect2($(this), ajaxUrl, placeholder, config);
        } else {
            initManualSelect2($(this), placeholder, config);
        }

        if ($(this).is('[data-add-new-value-url]')) {
            var addNewValueKey = $(this).data('add-new-value-key');
            addSelect2EventOpenListener($(this), addNewValueUrl, addNewValueKey);
        }
    });

    $('.input-checkbox-switch').change(function() {
        let inputLabel = $(this).siblings('label')
        let dataIfChecked = $(this).data('checked')
        let dataIfUnchecked = $(this).data('unchecked')

        if (this.checked) {
            inputLabel.text(dataIfChecked)
        } else {
            inputLabel.text(dataIfUnchecked)
        }
    })

    $('.input-numeric').keyup(function() {
        changeNonNumerikInputElement($(this))
    })

    $('.input-slug').keyup(function() {
        changeSlugInputValue($(this))
    })

    $('.rupiah').each(function() {
        let value = $(this).val();
        if (value == 0) {
            $(this).val("");
        } else {
            $(this).val(formatRupiah($(this).val(), 'Rp '));
        }
    })

    $('.rupiah').on('keyup', function() {
        $(this).val(formatRupiah($(this).val(), 'Rp '));
    })

    class MyUploadAdapter {
        constructor(loader) {
            this.loader = loader;
        }

        upload() {
            return this.loader.file
                .then(file => new Promise((resolve, reject) => {
                    this._initRequest();
                    this._initListeners(resolve, reject, file);
                    this._sendRequest(file);
                }));
        }

        abort() {
            if (this.xhr) {
                this.xhr.abort();
            }
        }

        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();

            xhr.open('POST', base_url+'/api/ckeditor/upload-image', true);
            xhr.responseType = 'json';
        }

        _initListeners(resolve, reject, file) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;

            xhr.addEventListener('error', () => reject(genericErrorText));
            xhr.addEventListener('abort', () => reject());
            xhr.addEventListener('load', () => {
                const response = xhr.response;
                console.log(response);

                if (!response || response.error) {
                    return reject(response && response.error ? response.error.message : genericErrorText);
                }

                resolve({
                    default: response.data.url
                });
            });

            if (xhr.upload) {
                xhr.upload.addEventListener('progress', evt => {
                    if (evt.lengthComputable) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                });
            }
        }
        _sendRequest(file) {
            const data = new FormData();

            data.append('upload', file);

            this.xhr.send(data);
        }
    }

    function ImageUploadAdapterPlugin(editor) {
        editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
            return new MyUploadAdapter(loader);
        };
    }

    if($('.ckeditor').length) {
        document.querySelectorAll('.ckeditor').forEach(e => {
            ClassicEditor
            .create(e, {
                extraPlugins: [ImageUploadAdapterPlugin],
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    e.value = editor.getData();
                });
            })
            .catch(error => {
                console.error(error);
            });
        })
    }

    if($('.tinymce').length) {
        const useDarkMode = sessionStorage.getItem('color-mode') == 'dark';

        tinymce.init({
            selector: 'textarea.tinymce',
            plugins: 'preview importcss searchreplace autolink autosave directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons accordion',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
                /* Provide file and text for the link dialog */
                if (meta.filetype === 'file') {
                    callback('https://www.google.com/logos/google.jpg', { text: 'My text' });
                }

                /* Provide image and alt text for the image dialog */
                if (meta.filetype === 'image') {
                    callback('https://www.google.com/logos/google.jpg', { alt: 'My alt text' });
                }

                /* Provide alternative source and posted for the media dialog */
                if (meta.filetype === 'media') {
                    callback('movie.mp4', { source2: 'alt.ogg', poster: 'https://www.google.com/logos/google.jpg' });
                }
            },
            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            skin: useDarkMode ? 'oxide-dark' : 'oxide',
            content_css: useDarkMode ? 'dark' : 'default',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
        });
    }
})

function formatRupiah(angka, prefix) {
    // Cek jika input kosong atau tidak valid
    if (angka == null || angka == undefined || angka == '' || angka == 0) {
        return '';
    }

    var number_string = String(angka).replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
}

function unformatRupiah(rupiah) {
    // Cek jika input kosong atau tidak valid
    if (!rupiah || typeof rupiah !== 'string') {
        return parseFloat(0);
    }
    // Hilangkan semua karakter kecuali angka dan koma
    var unformatted = rupiah.replace(/[^,\d]/g, '');
    // Ubah string menjadi angka dengan mengganti koma menjadi titik desimal jika ada
    var result = parseFloat(unformatted.replace(',', '.'));
    return result;
}

function changeNonNumerikInputElement(element) {
    let value = element.val();

    // Jika nilai kosong atau null, kembalikan kosong
    if (value === null || value === "") {
        element.val("");
        return;
    }

    // Hanya mengganti nilai jika mengandung karakter non-angka
    if (!/^\d+$/.test(value)) {
        let numericValue = value.replace(/[^\d]/g, '');
        element.val(numericValue ? parseInt(numericValue, 10) : "");
    }
}

function changeNonNumerikInputValue(value) {
    if (!/^\d+$/.test(value)) {
        return parseInt(value.replace(/[^\d]/g, ''), 10)
    }
    return value
}

function changeSlugInputValue(element) {
    element.val(slugify(element.val()))
}

function slugify(content) {
    return content. toLowerCase(). replace(/ /g,'-'). replace(/[^\w-]+/g,'');
}

function convertSlugToCapitalize(slug) {
    var words = slug.split('-');

    for (var i = 0; i < words.length; i++) {
      var word = words[i];
      words[i] = word.charAt(0).toUpperCase() + word.slice(1);
    }

    return words.join(' ');
}

function ucWords(str) {
    var splitStr = str.toLowerCase().split(' ');
    for (var i = 0; i < splitStr.length; i++) {
        // You do not need to check if i is larger than splitStr length, as your for does that for you
        // Assign it back to the array
        splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
    }
    // Directly return the joined string
    return splitStr.join(' ');
}

function confirmAction(content = {}, callback, option = {}) {
    Swal.fire({
        title: content.title ?? 'Are you sure?',
        text: content.text,
        icon: content.icon ?? 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3a57e8',
        cancelButtonColor: '#6c757d',
        confirmButtonText: content.confirmButtonText ?? 'Yes!',
        cancelButtonText: content.cancelButtonText ?? 'Cancel',
    }).then((result) => {
        if (result.value) {
            callback();
        }
    });
}

function popup(content = {}, callback, option = {}) {
    Swal.fire({
        title: content.title,
        text: content.text,
        icon: content.icon,
        showCancelButton: true,
        confirmButtonText: content.confirmButtonText,
        cancelButtonText: content.cancelButtonText
    }).then((result) => {
        if (result.isConfirmed) {
            // Panggil fungsi untuk melakukan AJAX request menghapus permission
            callback();
        }
    });
}

function formAjax(urlOrForm, method, option = {}, params){
    if (urlOrForm instanceof jQuery && urlOrForm.is('form')) {
        urlOrForm = urlOrForm.attr('action');
        method = urlOrForm.attr('method').toUpperCase();
        params= form.serialize();
    }
    // var form = $('#' + form_id);
    $('.text-error').empty();

    $.ajax({
        type: method,
        url: urlOrForm,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan CSRF token jika menggunakan Laravel
        },
        data: params,
        dataType: 'json',
        success: function(response) {
            if(response.redirectUrl){
                window.location.href = response.redirectUrl;
            } else {
                window.location.reload();
            }
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(field, messages) {
                    $('#' + field + '-error').empty();
                    var errorHtml = '<div class="text-danger">' + messages[0] + '</div>';
                    $('#' + field + '-error').append(errorHtml);
                });
            }
        }
    });
}

function generateRandomString(length = 8) {
    let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:<>,.?/~"
    let password = ""

    for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length)
        password += charset.charAt(randomIndex)
    }

    return password
}

function generateRandomText(length = 8) {
    let charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
    let password = ""

    for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * charset.length)
        password += charset.charAt(randomIndex)
    }

    return password
}

/* magnificPopup video view */
if($('.popup-video').length) {
    $(".popup-video").magnificPopup({
        type: "iframe",
        mainClass: 'mfp-zoom-in',
        removalDelay: 260,
    });
}
