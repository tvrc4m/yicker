/**
 * 
 */

// On ready
$( document ).on( "ready" , function() {
    stickyNav();
    mobileNavigation();
    scrollToPoint();
    navScrollTo();
    clientsSlider();
    featuresSlider();
    portfolio();
});


// On load
$( window ).on( "load" , function() {
    websiteLoading();
    parallaxStellar();
});


// On resize
$( window ).on( "resize" , function() {
    parallaxStellar();
});


/** [ 1.4 ] - Mobile Navigation
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function mobileNavigation() {
    $(".nav-mobile").html($("#main-menu").html());
    $(".nav-trigger").on( "click", function() {
        if ($(".nav-mobile ul").hasClass("expanded")) {
            $(".nav-mobile ul.expanded").removeClass("expanded").slideUp(300);
        } else {
            $(".nav-mobile ul").addClass("expanded").slideDown(300);
        }
    });
    // collapsed menu close on click
    $(document).on('click', '.nav-mobile ul li', function (e) {
        $(".nav-mobile ul.expanded").removeClass("expanded").slideUp(300);
    });
}



/** [ 1.5 ] - Scroll to
 *  ~~~~~~~~~~~~~~~~~~~
 */

function scrollToPoint() {
//jQuery for page scrolling feature - requires jQuery Easing plugin
    $('.scroll-to').on('click', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top -100
        }, 500, 'easeInOutExpo');
        e.preventDefault();
    });    
}



/** [ 1.6 ] - Stellar Parallax
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

// only activate stellar for window widths above or equal to 1024
var stellarActivated = false;

function parallaxStellar() {
    if ($(window).width() <= 1024) {
        if (stellarActivated == true) {
            $(window).data('plugin_stellar').destroy();
            stellarActivated = false;
        }
    } else {
        if (stellarActivated == false) {
            $.stellar({
                verticalOffset: 0,
                responsive: true,
                horizontalScrolling: false // don't change this option
           });
            $(window).data('plugin_stellar').init();
            stellarActivated = true;
        }
    }
}


/** [ 1.7 ] - Loader
 *  ~~~~~~~~~~~~~~~~
 */

function websiteLoading() {
    $( "#website-loading" ).delay( 600 ).fadeOut( 300 );
    $( ".loading-effect" ).delay( 0 ).fadeOut( 500 );   
}

/** [ 1.11] - Sticky Nav 
 *  ~~~~~~~~~~~~~~~~~~~~~
 */

function stickyNav() {
    $("#sticker").sticky({topSpacing:0});
}



/** [ 1.12] - ScrollTo Nav
 *  ~~~~~~~~~~~~~~~~~~~~~~~~
 */
   
function navScrollTo() {
    $.scrollIt({
    // If you change this values you will have strange effect
      upKey: false,           
      downKey: false,         
      scrollTime: 0,          
      activeClass: 'active',  
      onPageChange: null,     
      topOffset: -100         
    });
}


/** [ 1.15] - Portfolio Lightbox
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function portfolioLightbox() {
  $('.portfolio-lightboxportfolio-lightbox').magnificPopup({
    type: 'image'
  });
}



/** [ 1.16] - Portfolio Filter
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function portfolio() {
  // get the action filter option item on page load
  var $filterType = $('.portfolio-filter li.active a').attr('class');
  
  // get and assign the ourHolder element to the
  // $holder varible for use later
  var $holder = $('ul.portfolio-items-list');

  // clone all items within the pre-assigned $holder element
  var $data = $holder.clone();

  // attempt to call Quicksand when a filter option
  // item is clicked
  $('.portfolio-filter li a').on('click', function (e) {
    // reset the active class on all the buttons
    $('.portfolio-filter li').removeClass('active');
    
    // assign the class of the clicked filter option
    // element to our $filterType variable
    var $filterType = $(this).attr('class');
    $(this).parent().addClass('active');
    
    if ($filterType == 'all') {
      // assign all li items to the $filteredData var when
      // the 'All' filter option is clicked
      var $filteredData = $data.find('li');
    } 
    else {
      // find all li elements that have our required $filterType
      // values for the data-type element
      var $filteredData = $data.find('li[data-type~=' + $filterType + ']');
    }
    
    // call quicksand and assign transition parameters
    $holder.quicksand($filteredData, {
    duration: 700,
    easing: 'easeInOutQuint',
    useScaling: true,
    adjustHeight: 'dynamic'
    },
    function() {
     // callback function
     // portfolioLightbox();
    }
    );
    return false;
  });
}



/**
 *  -------------------------------------------------------------------------------
 *  [ 2 ] - Sliders
 *  -------------------------------------------------------------------------------
 *
 *  This section is for the sliders. It's based on owl carousel.
 *  
 *  ------
 *  
 *     |
 *     |-->  [ 2.1 ] - Clients Slider
 *     |-->  [ 2.2 ] - More Features Slider
 *     |-->  [ 2.3 ] - Header Animation Text lead gen
 *     |-->  [ 2.4 ] - Header Animation Text click through
 *  
 */



/** [ 2.1 ] - Clients Slider
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function clientsSlider() {
  $(".clients").owlCarousel({
      autoPlay: 5000, //Set AutoPlay to 3 seconds
      pagination: false, 
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
  });    
}



/** [ 2.2 ] - More Features Slider
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

function featuresSlider() {
  $(".more-features-slider").owlCarousel({
    autoPlay : false, // Integer means autoplay equal to the value. True means autoplay with 5 seconds
    stopOnHover : true,
    slideSpeed : 500,
    navigation : false,
    navigationText: ["<i class=\"fa fa-chevron-left\"></i>","<i class=\"fa fa-chevron-right\"></i>"],
    paginationSpeed : 400,
    transitionStyle : "fade", // "fade", "backSlide", "goDown" and "fadeUp"
    singleItem:true
  });    
}




/**
 *  -------------------------------------------------------------------------------
 *  [ 3 ] - Data Attributes Options
 *  -------------------------------------------------------------------------------
 *
 *  This part contains the codes of almost all data attribute options used for
 *  custom elements and css options
 *
 *  ------
 *
 *  It has the following code:
 *
 *     |
 *     |-->  [ 3.1 ] - Background Color
 *     |-->  [ 3.2 ] - Background Color Opacity
 *     |-->  [ 3.3 ] - Parallax Background Image
 *     |-->  [ 3.4 ] - Divider Space
 *     |-->  [ 3.5 ] - Pattern Overlay options
 *
 */



/** [ 3.1 ] - Background Color
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

// Custom background color
$( "*[data-background-color]" ).each(function() {
	var customBackgroundColor = $( this ).data( "background-color" );
	$( this ).css( "background-color" , customBackgroundColor );
});



/** [ 3.2 ] - Background Color Opacity
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

// Custom background color opacity
$( "*[data-background-color-opacity]" ).each(function() {
	var customBackgroundColorOpacity = $( this ).data( "background-color-opacity" ),
		backgroundColor = $( this ).css( "background-color" );

	// Conversion of rgb to rgba
	var rgbaBackgroundColor = backgroundColor.replace( "rgb" , "rgba" ).replace( ")" , ", " + customBackgroundColorOpacity + ")" );
	$( this ).css( "background-color" , rgbaBackgroundColor );
});



/** [ 3.3 ] - Parallax Background Image
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

// Custom Parallax background image
$( "*[data-parallax-background-image]" ).each(function() {
	var customParallaxBackgroundImage = $( this ).data( "parallax-background-image" );
	$( this ).css( "background-image" , "url('" + "./images/files/parallax-background-images/" + customParallaxBackgroundImage + "')" );
});



/** [ 3.4 ] - Divider Space
 *  ~~~~~~~~~~~~~~~~~~~~~~
 */

// Custom divider space 
$( "*[data-divider-space]" ).each(function() {
    var customDividerSpaceHeight = $( this ).data( "divider-space" );
    $( this ).css( "height" , parseInt( customDividerSpaceHeight ) );
});



/** [ 3.5 ] - Pattern Overlay options
 *  ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 */

// Custom pattern overlay darkness opacity
$( "*[data-pattern-overlay-darkness-opacity]" ).each(function() {
  // 0 value is not read by jquery, but 0.0 is read! in case of making condition "if"
  var patternOverlayDarknessOpacity = $( this ).data( "pattern-overlay-darkness-opacity" );
  $( this ).css( "background-color" , convertHex( "#000000" , patternOverlayDarknessOpacity ) );
});

// disable pattern overlay background image [ dots only ]
$( "*[data-pattern-overlay-background-image]" ).each(function() {
  if ( $( this ).data( "pattern-overlay-background-image" ) == "none" ) {
    $( this ).css( "background-image" , "none" );
  } else if ( $( this ).data( "pattern-overlay-background-image" ) == "yes" ) {
    $( this ).css( "background-image" );
  }
});

// remove pattern overlay
$( "*[data-remove-pattern-overlay]" ).each(function() {
  if ( $( this ).data( "remove-pattern-overlay" ) == "yes" ) {
    $( this ).css( "background" , "none" );
  /**
   *  In HTML, add expressive word like "none" to know what this option indicates for.  
   *  Using this word has no direct effect or any another word, it's only word with meaning 
   *  to help to know what this attribute value is doing.
   */
  }
});


// ===== Function to get rgba value of Hex color value ===== //
function convertHex( hex , opacity ){
  // var r, g, b, result;
    hex = hex.replace( '#' , '' );
    r = parseInt( hex.substring( 0 , 2 ) , 16 );
    g = parseInt( hex.substring( 2 , 4 ) , 16 );
    b = parseInt( hex.substring( 4 , 6 ) , 16 );

    result = 'rgba('+r+', '+g+', '+b+', '+opacity+')';
    return result;
}
