$(document).ready(function () {
    $(".delete-credit").click(function () {
        $('#delete-credit-modal form').attr('action', '/configurations/item/delete/' + $(this).data('item-id'));
    });

})