$(document).ready(function() {
    $('#personal').click(function(){
        if($('#personal').prop('checked')){
            $('.personal').slideDown();
        }else{
            $('.personal').slideUp();
        }
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
    $("#studio").on('change', function() {
        $.ajax({
            url: "/training-sessions/studio/" + $(this).val(),
            type: "get",
        })
        .done(function(data)
        {
            if(data.html !== ""){
        
                
                $('#room').empty();
                $('#coach').empty();
                $('#room').append(data.htmlRoom);            
                $('#coach').append(data.htmlCoach);    
                
                var rooms = $('#room');
                var rooms_instance = M.FormSelect.getInstance(rooms);
                var coaches = $('#coach');
                var coaches_instance = M.FormSelect.getInstance(coaches);
                
                rooms_instance.destroy();
                coaches_instance.destroy();

                M.FormSelect.init(coaches, {});
                M.FormSelect.init(rooms, {});
            }
        })
        .fail(function(jqXHR, ajaxOptions, thrownError)
        {
            Materialize.toast("Server not responding...", 3000);
        });
    });
});