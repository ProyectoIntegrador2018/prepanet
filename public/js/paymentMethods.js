$(document).ready(function () {
    $(".delete-payment-method").click(function () {
        $('#deactivate-paymentMethod-modal form').attr('action', '/configurations/payment-methods/deactivate/' + $(this).data('studio-id') + '/' + $(this).data('payment-method-id'));
    });

})