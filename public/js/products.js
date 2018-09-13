$(document).ready(function () {
    $(".delete-product").click(function () {
        $('#delete-product-modal form').attr('action', '/configurations/item/delete/' + $(this).data('item-id'));
    });

})