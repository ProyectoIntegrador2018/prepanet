$(document).ready(function () {
    $(".delete-room").click(function () {
        $('#delete-room-modal form').attr('action', '/rooms/delete/' + $(this).data('room-id'));
    });

})