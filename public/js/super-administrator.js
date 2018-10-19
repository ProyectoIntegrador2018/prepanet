$(document).ready(function () {
    $(".delete-super-administrator").click(function () {
        $('#delete-super-administrator-modal form').attr('action', '/super-administrators/delete/' + $(this).data('super-administrator-id'));
    });

})
