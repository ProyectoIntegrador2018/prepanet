$(document).ready(function () {
    $(".delete-subscription").click(function () {
        $('#delete-subscription-modal form').attr('action', '/configurations/item/delete/' + $(this).data('item-id'));
    });

})