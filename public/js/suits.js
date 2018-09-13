$(document).ready(function () {
    $(".delete-suit").click(function () {
        $('#delete-suit-modal form').attr('action', '/suits/delete/' + $(this).data('suit-id'));
    });

})