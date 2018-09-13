$(document).ready(function () {
    $(".delete-training-device").click(function () {
        $('#delete-training-device-modal form').attr('action', '/training-devices/delete/' + $(this).data('training-device-id'));
    });

})