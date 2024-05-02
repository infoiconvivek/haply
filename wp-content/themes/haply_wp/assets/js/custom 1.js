/*=====================================================================
    ==========================  Scroll-Preloader  =========================
    ========================================================================*/

var progressPath = document.querySelector('.progress-wrap path');
var pathLength = progressPath.getTotalLength();
progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
progressPath.style.strokeDashoffset = pathLength;
progressPath.getBoundingClientRect();
progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength / height);
    progressPath.style.strokeDashoffset = progress;
}
updateProgress();
$(window).scroll(updateProgress);
var offset = 50;
var duration = 0;
jQuery(window).on('scroll', function () {
    if (jQuery(this).scrollTop() > offset) {
        jQuery('.progress-wrap').addClass('active-progress');
    } else {
        jQuery('.progress-wrap').removeClass('active-progress');
    }
});
jQuery('.progress-wrap').on('click', function (event) {
    event.preventDefault();
    jQuery('html, body').animate({ scrollTop: 0 }, duration);
    return false;
})

// Preloader
var win = $(window);
win.on('load', function () {
    $('#pre-loader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})

// if ($(window).width() > 991) {
//     new WOW().init();
// }

/*========================================================================================================
================================ Sticky header ===================================================================
===========================================================================================================*/



$(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll > 80) {
         $('.header').addClass('sticky');
        $('.menu').addClass('menuSticky');
        $('.hwto-social').addClass('fixed-bottom');
    } else {
         $('.header').removeClass('sticky');
        $('.menu').removeClass('menuSticky');
    }
});

/*=====================================================================
    ==========================  ScrollToptoBottom  =========================
    ========================================================================*/

$(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
        $('#scroll').fadeIn();
    } else {
        $('#scroll').fadeOut();
    }
});
$('#scroll').click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});




/*========================================================================================================
================================ slider-home owlCarousel ===================================================================
===========================================================================================================*/

$('.testimonial-carousel').owlCarousel({
    loop: true,
    responsiveClass: true,
    nav: true,
    margin: 0,
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 5
        },
        1200: {
            items: 5
        }
    }
});

/*========================================================================================================
================================Tooltips ===================================================================
===========================================================================================================*/
if ($('.toltip').length) {



    $(".toltip").hover(
        function () {
            let show = $(this).parents("li").find('.toltipBx');
            console.log("Length: ", show.length);

            if (show.length > 0) {
                $(this).parents("li").addClass("oToltip");
            }
        },
        function () {
            $(this).parents("li").removeClass("oToltip");
        }
    );
}

$("#color_change p").click(function () {
    $("#color_change").toggleClass("show");
    $(this).find('i').toggleClass('fa-fill-drip fa-xmark')
})

$(".navbar-toggler").click(function () {
    $(this).find('i').toggleClass('fa-bars fa-xmark')
})
/*
$(".featureBtn").hover(function () {
    $(this).html(function (i, html) {
        return html.indexOf('Hide') !== -1 ? 'See all how-to articles' : 'Prøv vores demo';
    });
}, function () {
    $(this).html(function (i, html) {
        return html.indexOf('Hide') !== -1 ? 'Prøv vores demo' : 'See all how-to articles';
    });
})
*/
// themes color change
$("#color_change li").click(function () {
    var colorClass = $(this).attr("class");
    $("body[class^='bg-']").removeClass(function (index, className) {
        return (className.match(/\bbg-\S+/g) || []).join(' ');
    });
    $("body").removeClass("bg-white bg-green bg-red bg-blue bg-yellow").addClass(colorClass);
});











$('.about #search-category').keyup(function () {
    var search_term = $('#myInput').val();

    // alert(search_term);

    $('.highlight-text').removeHighlight().highlight(search_term);
    // $('#how_to_datafetch a').removeHighlight().highlight(search_term);
});


$('.about #search-category').keyup(function () {
    var search_term_1 = $('#how_to_datafetch a').val();
    $('#how_to_datafetch a').removeHighlight().highlight(search_term_1);
});

//  $('a[data-toggle="tooltip"]').tooltip({
//     animated: 'fade',
//     placement: 'bottom',
//     html: true
// });


// $("body.body-black-theme header #header_search .is-search-form").keyup(function () {
//     $(".body-black-them .search-form .is-search-submit").css({ "background-color": "#000000" });
//     $(".body-black-them .search-form .is-search-submit svg path").css({ "fill": "#ffffff" });
//     $(this).removeAttr('placeholder');

// });

// $("header #header_search .is-search-form").keyup(function () {
//     $(".search-form .is-search-submit").css({ "background-color": "#ffffff" });
//     $(".search-form .is-search-submit svg path").css({ "fill": "#129e41" });
//     $(this).removeAttr('placeholder');
// });




$("#search-category").keyup(function () {
    $("#search-category button").css({ "background-color": "#000000", 'color': '#ffffff' });
    $("#search-category button svg path").css({ "fill": "#ffffff" });
    $(this).css({ "background-color": "#ffff", "color": "#000000" });
    $("#search-category input").removeAttr('placeholder').css("border", "1px solid #000000");
});


$('.price-bx ul li').hover(function() {
    const index = $(this).index(); 
    $('.price-bx').each(function() {
    $(this).find('ul li').eq(index).addClass('highlight');
});
}, 
function() {
	$('.price-bx ul li').removeClass('highlight');
});
    

    
    
$(document).ready(function() {

    var showingAll = false;
    // Function to toggle visibility of list items
    function toggleListItems() {
            if (showingAll) {
                $(".price-bx ul").each(function() {
                $(this).find("li").show();
            });
        } else {
            $(".price-bx ul").each(function() {
            $(this).find("li:gt(5)").hide();
            });
        }
        showingAll = !showingAll;
    }

    $(".price-bx ul").each(function() {
        $(this).find("li:gt(5)").hide();
        $(this).css("padding-bottom","20px");
    });


    $("#toggleButton").click(function() {
        toggleListItems();
    });

    var imgHeight = $('.leftImg_style img').height();
    var hasButton = $('.home-content-wrap').find('.custom-btn').length > 0;
    var desiredTextHeight = hasButton ? imgHeight - 50 : imgHeight;
    $('.home-content-wrap .text_content').css('max-height', desiredTextHeight + 'px','margin-bottom','0px');
       
});