$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $(".button-collapse").sidenav();


    M.Sidenav.init($('.sidenav'), {});
    M.Sidenav.init($('.right-sidenav'), {edge: 'right'});
    M.Tooltip.init($('.tooltipped'), {});
    M.Collapsible.init($('.collapsible'), {});
    M.FloatingActionButton.init($('.fixed-action-btn'), {});
    M.Datepicker.init($('.datepicker'), {format: 'mmmm d, yyyy', yearRange: 100});
    M.FormSelect.init($('select'), {dropdownOptions: {container: document.body}});
    M.Timepicker.init($('.timepicker'), {defaultTime: 'now'});
    M.Tabs.init($('.tabs'), {onShow: function() {
        if(typeof $grid != 'undefined'){
            $grid.masonry('reloadItems'); 
            $grid.masonry('layout');
        }
    }});

    M.Modal.init($('.modal'), {onOpenEnd: function() {
        if(typeof $grid != 'undefined'){
            $grid.masonry('reloadItems'); 
            $grid.masonry('layout');
        }
    }}); 
});
