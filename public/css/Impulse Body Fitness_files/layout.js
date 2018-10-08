$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(".button-collapse").sideNav();
    $('.modal').modal();
    $('select').material_select();
    $('.collapsible').collapsible();
});
