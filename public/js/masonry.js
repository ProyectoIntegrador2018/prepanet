var $grid = ''


$(window).on('load', function(){ 
    $grid = $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-item',
        isAnimated: false
    });    
});

