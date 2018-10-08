$(document).ready(function () {
    $(".delete-super-administrator").click(function () {
        $('#delete-super-administrator-modal form').attr('action', '/super-administrator/delete/' + $(this).data('super-administrator-id'));
    });

})
