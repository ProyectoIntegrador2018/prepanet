$(document).ready(function () {
    $(".delete-currency").click(function () {
        $('#delete-currency-modal form').attr('action', '/currencies/delete/' + $(this).data('currency-id'));
    });

})