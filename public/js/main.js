$(document).ready(function() {

    const url = window.location.href.split('/').slice(0, 5).join('/');

    const targetLink = $('a.nav-link[href="'+url+'"]');

    if (targetLink.length > 0) {
        targetLink.closest('.has-treeview').addClass('menu-open')
        targetLink.closest('.has-treeview').find('a.nav-link').first().addClass('active')
        targetLink.addClass('active');
    }

    $('#modal-delete').on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const url = button.data('route');
        const modal = $(this);
        modal.find('.delete-form').attr('action', url);
    });

    $('.select2').select2();

    const errorMessage = $("#error-message").val();
    if(errorMessage !== undefined && errorMessage !== "") {
        $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Ошибка',
            body: errorMessage,
        });
    }

});

$(function () {
    $('.picker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        language: 'ru'
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const inputFile = document.getElementById('exampleInputFile');
    if (inputFile) {
        inputFile.addEventListener('change', function() {
            document.getElementById('fileInputLabel').textContent = this.files[0].name;
        });
    }
});
