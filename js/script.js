$(document).ready(function() {
    if (typeof jQuery === 'undefined') {
        console.log("jQuery Undefined");
    }else {
        console.log("Loaded");
    }

    $('.read-more-content').addClass('hide');

    $('.read-more-toggle').on('click', function() {
      $(this).next('.read-more-content').toggleClass('hide');
    });
});

