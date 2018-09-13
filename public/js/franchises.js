$(document).ready(function () {
    $(".delete-studio").click(function () {
        $('#delete-studio-modal form').attr('action', '/studios/delete/' + $(this).data('studio-id'));
    });

})