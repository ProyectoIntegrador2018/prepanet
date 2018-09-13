$(document).ready(function () {
    
   


    $("#space").height($('#checkout-button').height() * .50);

    $( ".singleQty" ).change(function() {
        if($(this).val() != 1)
            $(this).val(1);
    });

    $('#user').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            e.preventDefault();
            $('#search_user_btn').click();
            $('#user').blur();
        }
    }); 

    $( "#search_user_btn" ).on( "click", function() {
       
        $.ajax({
            url: "/customers/listing",
            type: "post",
            data: {'query' : $('#user').val()},
        })
        .done(function(data)
        {
            
            if(data.html !== ""){
                $("#users-list").empty();
                $("#users-list").append(data.html);
                $( ".customer-item" ).on( "click", function() {
                    $("#user").val($(this).data('email'));
                    $("#users-list").empty();
                });
            }
    
        });
    });

    $( ".item" ).on( "click", function() {
        if($('#subscriptionInCart').length == 0 || !($( this ).hasClass( "subscription" ))){                
            if ($('#cart' + $(this).data('item')).length > 0) { 
                $('#qty' + $(this).data('item')).val( function(i, oldval) {
                    return ++oldval;
                });
            }
            else{
                $.ajax({
                    url: "/store/add/" + $(this).data('item'),
                    type: "post",
                })
                .done(function(data)
                {
                    
                    if(data.html !== ""){
                        if($('.cart-item').length == 0)
                        {
                            $('#checkout-button').show();
                        }
                        $("#cart-summary").append(data.html);

                        $( ".singleQty" ).change(function() {
                            if($(this).val() != 1){
                                $(this).val(1);
                                M.toast({html: 'You cannot buy more than one subscription'});                                        
                            }
                        });
                    }
                });
            }
        }
        else{
            M.toast({html: 'A subscription is already in cart'});
        }
    });

    
})
function checkout() {
    $('#items').val('');
    $('#quantities').val('');
    $( ".cart-item" ).each(function() {
        $('#items').val($('#items').val() + $(this).data('item') + ',');
        $('#quantities').val($('#quantities').val() + $('#qty' + $(this).data('item')).val() + ',');
    });

    $.ajax({
        url: "/store/checkout",
        type: "get",
        data: {'items': $('#items').val(), 'quantities': $('#quantities').val()},
    })
    .done(function(data)
    {
        $("#checkout-info").empty();
        
        if(data.html !== ""){
            $("#checkout-info").append(data.html);
        }
        
        var checkout = $('#checkout-modal');
    
        M.Modal.init(checkout);
    
        var checkoutInstance = M.Modal.getInstance(checkout);
        $('#user').autocomplete({
            data: data.users,
        });
    
        checkoutInstance.open();
    });

}

function remove(id) {
    $('#' + id).remove();
    if($('.cart-item').length == 0)
    {
        $('#checkout-button').hide();
    }
}

$('#search-form').on("submit", function(event,ui) {
    event.preventDefault();
    
    $.ajax({
        url: "/store/search",
        type: "post",
        data: $('#search-form').serialize(),
    })
    .done(function(data)
    {
        $("#search-results").empty();
        
        if(data.html !== ""){
            $("#search-results").append(data.html);
            
            $grid.masonry('reloadItems'); 
            $grid.masonry('layout');
           
            $( ".item" ).on( "click", function() {
                if($('#subscriptionInCart').length == 0 || !($( this ).hasClass( "subscription" ))){                
                    if ($('#cart' + $(this).data('item')).length > 0) { 
                        $('#qty' + $(this).data('item')).val( function(i, oldval) {
                            return ++oldval;
                        });
                    }
                    else{
                        $.ajax({
                            url: "/store/add/" + $(this).data('item'),
                            type: "post",
                        })
                        .done(function(data)
                        {
                            
                            if(data.html !== ""){
                                if($('.cart-item').length == 0)
                                {
                                    $('#checkout-button').show();
                                }
                                $("#cart-summary").append(data.html);

                                $( ".singleQty" ).change(function() {
                                    if($(this).val() != 1){
                                        $(this).val(1);
                                        M.toast({html: 'You cannot buy more than one subscription'});                                        
                                    }
                                });
                            }
                        });
                    }
                }
                else{
                    M.toast({html: 'A subscription is already in cart'});
                }
            });

        }

    });

});