$(document).ready(function () {
    $(".delete-tutor").click(function () {
        $('#delete-tutor-modal form').attr('action', '/tutores/delete/' + $(this).data('tutor-id'));
    });

})
