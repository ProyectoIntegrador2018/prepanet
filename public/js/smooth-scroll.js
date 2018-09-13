$(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: ($($.attr(this, 'href')).offset().top - $('nav').height() - 5)
    }, 500);
});