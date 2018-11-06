$(document).ready(function () {
    $(".delete-tetra").click(function () {
        $('#delete-tetra-modal form').attr('action', '/tetras/delete/' + $(this).data('tetra-id'));
    });

})
