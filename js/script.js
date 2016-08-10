$(document).ready(function() {
    if (typeof jQuery === 'undefined') {
        console.log("jQuery Undefined");
    }else {
        console.log("Loaded");
    }

    $('.stuff').readmore({
        speed:75
    });
});

