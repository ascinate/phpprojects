// NAV SCROLL
// Hide Header on on scroll down
// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('header').removeClass('nav-up').addClass('nav-down');
        }
    }
    
    lastScrollTop = st;
}

// NICE SELECT
$(document).ready(function() {
    $('select').niceSelect();
});

// SIDEBAR LISTS
$(document).ready(function(){
    $('#year-2019').click(function(){
        $('#months-2019').toggleClass('hide-me');
    });
    $('#jan-2019').click(function(){
        $('#jan-2019-weeks').toggleClass('hide-me');
    });
    $('#feb-2019').click(function(){
        $('#feb-2019-weeks').toggleClass('hide-me');
    });
    $('#march-2019').click(function(){
        $('#march-2019-weeks').toggleClass('hide-me');
    });
    $('#april-2019').click(function(){
        $('#april-2019-weeks').toggleClass('hide-me');
    });
    $('#may-2019').click(function(){
        $('#april-2019-weeks').toggleClass('hide-me');
    });
    $('#june-2019').click(function(){
        $('#june-2019-weeks').toggleClass('hide-me');
    });
    $('#july-2019').click(function(){
        $('#july-2019-weeks').toggleClass('hide-me');
    });
    $('#august-2019').click(function(){
        $('#august-2019-weeks').toggleClass('hide-me');
    });
    $('#september-2019').click(function(){
        $('#september-2019-weeks').toggleClass('hide-me');
    });
    $('#october-2019').click(function(){
        $('#october-2019-weeks').toggleClass('hide-me');
    });
    $('#november-2019').click(function(){
        $('#november-2019-weeks').toggleClass('hide-me');
    });
    $('#december-2019').click(function(){
        $('#december-2019-weeks').toggleClass('hide-me');
    });



    $('#year-2018').click(function(){
        $('#months-2018').toggleClass('hide-me');
    });
    $('#jan-2018').click(function(){
        $('#jan-2018-weeks').toggleClass('hide-me');
    });
    $('#feb-2018').click(function(){
        $('#feb-2018-weeks').toggleClass('hide-me');
    });
    $('#march-2018').click(function(){
        $('#march-2018-weeks').toggleClass('hide-me');
    });
    $('#april-2018').click(function(){
        $('#april-2018-weeks').toggleClass('hide-me');
    });
    $('#may-2018').click(function(){
        $('#april-2018-weeks').toggleClass('hide-me');
    });
    $('#june-2018').click(function(){
        $('#june-2018-weeks').toggleClass('hide-me');
    });
    $('#july-2018').click(function(){
        $('#july-2018-weeks').toggleClass('hide-me');
    });
    $('#august-2018').click(function(){
        $('#august-2018-weeks').toggleClass('hide-me');
    });
    $('#september-2018').click(function(){
        $('#september-2018-weeks').toggleClass('hide-me');
    });
    $('#october-2018').click(function(){
        $('#october-2018-weeks').toggleClass('hide-me');
    });
    $('#november-2018').click(function(){
        $('#november-2018-weeks').toggleClass('hide-me');
    });
    $('#december-2018').click(function(){
        $('#december-2018-weeks').toggleClass('hide-me');
    });

    $('#year-2017').click(function(){
        $('#months-2017').toggleClass('hide-me');
    });
    $('#jan-2017').click(function(){
        $('#jan-2017-weeks').toggleClass('hide-me');
    });
    $('#feb-2017').click(function(){
        $('#feb-2017-weeks').toggleClass('hide-me');
    });
    $('#march-2017').click(function(){
        $('#march-2017-weeks').toggleClass('hide-me');
    });
    $('#april-2017').click(function(){
        $('#april-2017-weeks').toggleClass('hide-me');
    });
    $('#may-2017').click(function(){
        $('#april-2017-weeks').toggleClass('hide-me');
    });
    $('#june-2017').click(function(){
        $('#june-2017-weeks').toggleClass('hide-me');
    });
    $('#july-2017').click(function(){
        $('#july-2017-weeks').toggleClass('hide-me');
    });
    $('#august-2017').click(function(){
        $('#august-2017-weeks').toggleClass('hide-me');
    });
    $('#september-2017').click(function(){
        $('#september-2017-weeks').toggleClass('hide-me');
    });
    $('#october-2017').click(function(){
        $('#october-2017-weeks').toggleClass('hide-me');
    });
    $('#november-2017').click(function(){
        $('#november-2017-weeks').toggleClass('hide-me');
    });
    $('#december-2017').click(function(){
        $('#december-2017-weeks').toggleClass('hide-me');
    });



    $('#year-2016').click(function(){
        $('#months-2016').toggleClass('hide-me');
    });
    $('#jan-2016').click(function(){
        $('#jan-2016-weeks').toggleClass('hide-me');
    });
    $('#feb-2016').click(function(){
        $('#feb-2016-weeks').toggleClass('hide-me');
    });
    $('#march-2016').click(function(){
        $('#march-2016-weeks').toggleClass('hide-me');
    });
    $('#april-2016').click(function(){
        $('#april-2016-weeks').toggleClass('hide-me');
    });
    $('#may-2016').click(function(){
        $('#april-2016-weeks').toggleClass('hide-me');
    });
    $('#june-2016').click(function(){
        $('#june-2016-weeks').toggleClass('hide-me');
    });
    $('#july-2016').click(function(){
        $('#july-2016-weeks').toggleClass('hide-me');
    });
    $('#august-2016').click(function(){
        $('#august-2016-weeks').toggleClass('hide-me');
    });
    $('#september-2016').click(function(){
        $('#september-2016-weeks').toggleClass('hide-me');
    });
    $('#october-2016').click(function(){
        $('#october-2016-weeks').toggleClass('hide-me');
    });
    $('#november-2016').click(function(){
        $('#november-2016-weeks').toggleClass('hide-me');
    });
    $('#december-2016').click(function(){
        $('#december-2016-weeks').toggleClass('hide-me');
    });


    $('#year-2015').click(function(){
        $('#months-2015').toggleClass('hide-me');
    });
    $('#jan-2015').click(function(){
        $('#jan-2015-weeks').toggleClass('hide-me');
    });
    $('#feb-2015').click(function(){
        $('#feb-2015-weeks').toggleClass('hide-me');
    });
    $('#march-2015').click(function(){
        $('#march-2015-weeks').toggleClass('hide-me');
    });
    $('#april-2015').click(function(){
        $('#april-2015-weeks').toggleClass('hide-me');
    });
    $('#may-2015').click(function(){
        $('#april-2015-weeks').toggleClass('hide-me');
    });
    $('#june-2015').click(function(){
        $('#june-2015-weeks').toggleClass('hide-me');
    });
    $('#july-2015').click(function(){
        $('#july-2015-weeks').toggleClass('hide-me');
    });
    $('#august-2015').click(function(){
        $('#august-2015-weeks').toggleClass('hide-me');
    });
    $('#september-2015').click(function(){
        $('#september-2015-weeks').toggleClass('hide-me');
    });
    $('#october-2015').click(function(){
        $('#october-2015-weeks').toggleClass('hide-me');
    });
    $('#november-2015').click(function(){
        $('#november-2015-weeks').toggleClass('hide-me');
    });
    $('#december-2015').click(function(){
        $('#december-2015-weeks').toggleClass('hide-me');
    });
});

// MUSIC PLAYER
$(document).ready(function(){
    $(".example").musicPlayer();
});

// LINK-ANIMATE-JUMP
$("a[href^='#']").click(function(e) {
	e.preventDefault();
	var position = $($(this).attr("href")).offset().top;
	$("body, html").animate({
		scrollTop: position
	}, 2000 );
});


// OWL CAROUSEL
$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:6000,
        nav:true,
        navText : ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        
        smartSpeed:450,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });
});


// particlesjs
particlesJS("particles-js", 
{
    "particles":{
        "number":{
            "value":118,
            "density":{
                "enable":true,
                "value_area":1578.2952832645453}
            }
            ,"color":{
                "value":"#fce8ff"
            },"shape":{
                "type":"circle",
                "stroke":{
                    "width":0,
                    "color":"#000000"
                },"polygon":{
                    "nb_sides":5
                },"image":{
                    "src":"img/github.svg","width":100,"height":100
                }
            },"opacity":{
                "value":0.16034120608655228,
                "random":true,
                "anim":{
                    "enable":true,
                    "speed":0,
                    "opacity_min":0,
                    "sync":true
                }
            },"size":{
                "value":14.042650760819036,
                "random":true,
                "anim":{
                    "enable":true,
                    "speed":70.65071747021703,
                    "size_min":30.738161944437664,
                    "sync":true
                }
            },"line_linked":{
                "enable":false,
                "distance":500,
                "color":"#ffffff",
                "opacity":0.4,
                "width":2
            },"move":{
                "enable":true,
                "speed":1,
                "direction":"top",
                "random":true,
                "straight":false,
                "out_mode":"out",
                "bounce":false,
                "attract":{
                    "enable":true,
                    "rotateX":600,
                    "rotateY":1200
                }
            }
        },"interactivity":{
            "detect_on":"canvas",
            "events":{
                "onhover":{
                    "enable":true,
                    "mode":"repulse"
                },"onclick":{
                    "enable":true,
                    "mode":"repulse"
                },"resize":true
            },"modes":{
                "grab":{
                    "distance":400,
                    "line_linked":{
                        "opacity":0.5
                    }
                },"bubble":{
                    "distance":400,
                    "size":4,
                    "duration":0.3,
                    "opacity":1,
                    "speed":3
                },"repulse":{
                    "distance":200,
                    "duration":0.4
                },"push":{
                    "particles_nb":4
                },"remove":{
                    "particles_nb":2
                }
            }
        },"retina_detect":true});
             

// scroll the tracks window
const slider = document.querySelector(".scroll");
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener("mousedown", e => {
  isDown = true;
  slider.classList.add("active");
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener("mouseleave", () => {
  isDown = false;
  slider.classList.remove("active");
});
slider.addEventListener("mouseup", () => {
  isDown = false;
  slider.classList.remove("active");
});
slider.addEventListener("mousemove", e => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = x - startX;
  slider.scrollLeft = scrollLeft - walk;
});



