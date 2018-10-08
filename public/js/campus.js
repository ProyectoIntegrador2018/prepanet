$(document).ready(function () {
    $(".delete-campus").click(function () {
        $('#delete-campus-modal form').attr('action', '/campuses/delete/' + $(this).data('campus-id'));
    });

})
