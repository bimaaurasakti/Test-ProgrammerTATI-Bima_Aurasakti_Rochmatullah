$(document).ready(function(){

    // Selector
    let card = $('#card_form')
    let table = $('#table_dynamic_forms')
    let buttonAddForm = $('#button_add_form')

    // Element
    let deletedInput = $('<input type="hidden" name="deleted_id[]" />');

    // Add Form
    buttonAddForm.on('click', function(){
        let tr = table.find('tbody').find('tr').eq(0).clone()
        let inputs = tr.find('input')
        tr.find('input').val('')
        tr.find('.button-delete-form').removeAttr('data-id')
        inputs.each(function () {
            $(this).attr('name', 'new_'+$(this).data('name'))
        })
        table.find('tbody').append(tr)
        reindex()
    })

    // Update form
    table.on('keyup', 'input', function(){
        let inputs = $(this).closest('tr').find('input')
        inputs.each(function () {
            if ($(this).attr('name') === undefined) {
                $(this).attr('name', $(this).data('name'))
            }
        })
    })

    // Delete Form
    table.on('click', '.button-delete-form', function(){
        let tr = $(this).closest('tr')
        let id = $(this).data('id')
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this form?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3a57e8',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                tr.remove()
                if (id) {
                    card.append(deletedInput.clone().val(id))
                }
                reindex()
            }
        });
    })

    function reindex() {
        table.find('tbody').find('tr').each(function(index){
            $(this).find('td').eq(0).text(index + 1)
        })
    }

})
