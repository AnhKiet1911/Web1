// JavaScript Document

$(window).load(function () {
    //flexslider
    $('.flexslider').flexslider({
        animation: "slide",
        controlNav: false
    });
});
//thanh menu left

// js menu top
$(document).ready(function () {
    $('.nav ul.child').removeClass('child');
    $('.nav li').has('ul').hover(function () {
        $(this).children('ul').addClass('shadow').slideDown(150);
    },
            function () {
                $(this).children('ul').stop(true, true).slideUp(150);
            }
    );
});
