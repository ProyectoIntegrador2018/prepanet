$(document).ready(function () {
    $(".delete-gerente").click(function () {
        $('#delete-gerente-modal form').attr('action', '/gerentes/delete/' + $(this).data('gerente-id'));
    });

})
