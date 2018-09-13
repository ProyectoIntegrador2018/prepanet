$(document).ready(function () {
    $(".delete-company").click(function () {
        $('#delete-company-modal form').attr('action', '/companies/delete/' + $(this).data('company-id'));
    });

})