$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if(scroll >= 20) {
        $('header').addClass("fixed-top");
    }else{
        $('header').removeClass("fixed-top");
    }
});

$('[data-toggle="tooltip"]').tooltip()

setTimeout(function(){
    $('body').css('min-height', $(window).outerHeight());
    $('.login_signup_block').css('min-height',$(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight()))
    $('.body_section,.inner_body_section').css('min-height', $(window).outerHeight());
    //$('.body_section').css('padding-top', $('header').outerHeight());
    $('.login_body_section,.inner_body_section,.inner_page_banner').css('padding-top', $('header').outerHeight());
    $('.body_section,.inner_body_section,.login_body_section').css('padding-bottom', $('footer').outerHeight());
    $('.after_login_block').css('min-height' , $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight()))
}, 50);

$(window).resize(function(){
    $('body').css('min-height', $(window).outerHeight());
    $('.login_signup_block').css('min-height',$(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight()))
    $('.body_section,.inner_body_section').css('min-height', $(window).outerHeight());
    //$('.body_section').css('padding-top', $('header').outerHeight());
    $('.login_body_section,.inner_body_section,.inner_page_banner').css('padding-top', $('header').outerHeight());
    $('.body_section,.inner_body_section,.login_body_section').css('padding-bottom', $('footer').outerHeight());
    $('.after_login_block').css('min-height' , $(window).outerHeight() - ($('header').outerHeight() + $('footer').outerHeight()))
});

// JavaScript for label effects only
$(".form-group input").val("");
$(".input_effects input").focusout(function(){
    if($(this).val() != ""){
        $(this).addClass("has-content");
    }else{
        $(this).removeClass("has-content");
    }
})


/* fantasy sports slider */
/*$('.fantasy_sports_slider').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    dots: false,
    autoplay: false,
    //center: true,
    /*stagePadding: 310,*/
    /*responsive: {
        320: {
            items: 1
        },
        480: {
            items: 2
        },
        640: {
            items: 2
        },
        768: {
            items: 3
        },
        992: {
            items: 3
        },
        1200: {
            items: 3
        }
    }*/
//});*/

/* our fans slider */
$('.our_fans_slider').owlCarousel({
    loop: true,
    margin: 5,
    nav: false,
    dots: false,
    autoplay: true,
    //center: true,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 1
        },
        640: {
            items: 1
        },
        768: {
            items: 1
        },
        992: {
            items: 1
        },
        1200: {
            items: 1
        }
    }
});

/*Listing Page Equal div height*/
$(window).resize(function(){
    $('.listing_content_panels_img').each(function() {
      $(this).height($(this).width());
    });
}).resize();





