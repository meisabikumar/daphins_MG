$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if (scroll >= 20) {
        $('header').addClass("fixed-top");
    } else {
        $('header').removeClass("fixed-top");
    }
});

setTimeout(function(){
    $('body').css('min-height', $(window).outerHeight());
    $('.body_section').css('min-height', $(window).outerHeight());
    $('.body_section').css('padding-bottom', $('footer').outerHeight());
}, 50);

$(window).resize(function(){
    $('body').css('min-height', $(window).outerHeight());
    $('.body_section').css('min-height', $(window).outerHeight());
    $('.body_section').css('padding-bottom', $('footer').outerHeight());
});

if($(window).width() < 992){
    $('.top_banner_block').css('padding-top' , $('header').outerHeight());
}

//top_players_slider
$('.top_players_slider').owlCarousel({
    //rtl:false,            
    loop: false,
    margin: 10,
    nav: true,
    navText : ["",""],
    dots: false,
    autoplay: true,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 2
        },
        576: {
            items: 2
        },
        768: {
            items: 4
        },
        992: {
            items: 5
        },
        1200: {
            items: 6
        }
    }
});

//register_list_slider
$('.register_list_slider').owlCarousel({
    //rtl:false,            
    loop: true,
    margin: 0,
    nav: true,
    //navText : ["",""],
    dots: false,
    autoplay: true,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 1
        },
        576: {
            items: 2
        },
        768: {
            items: 2
        },
        992: {
            items: 2
        },
        1200: {
            items: 2
        }
    }
});

//say_about_client_slider
$('.say_about_client_slider').owlCarousel({
    //rtl:false,            
    loop: true,
    margin: 0,
    nav: true,
    //navText : ["",""],
    dots: false,
    autoplay: true,
    items: 1,
});

//partners_sliders
$('.partners_sliders').owlCarousel({
    //rtl:false,            
    loop: true,
    margin: 0,
    nav: true,
    //navText : ["",""],
    dots: false,
    autoplay: false,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 2
        },
        576: {
            items: 3
        },
        768: {
            items: 3
        },
        992: {
            items: 4
        },
        1200: {
            items: 4
        }
    }
});

//our_team_slider
$('.our_team_slider').owlCarousel({
    //rtl:false,            
    loop: true,
    margin: 0,
    nav: true,
    //navText : ["",""],
    dots: false,
    autoplay: false,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 2
        },
        576: {
            items: 2
        },
        768: {
            items: 3
        },
        992: {
            items: 4
        },
        1200: {
            items: 4
        }
    }
});

//fixtures_table_slider
$('.fixtures_table_slide').owlCarousel({
    //rtl:false,            
    loop: true,
    margin: 30,
    nav: true,
    //navText : ["",""],
    dots: false,
    autoplay: false,
    responsive: {
        320: {
            items: 1
        },
        480: {
            items: 1
        },
        576: {
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



