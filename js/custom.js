/*-----------------------------------------------------------------------------------*/
/*	IMAGE HOVER
/*-----------------------------------------------------------------------------------*/
jQuery(function() {
    // OPACITY OF BUTTON SET TO 50%
    jQuery('.one_fourth a img').css("opacity","1.0");	
    // ON MOUSE OVER
    jQuery('.one_fourth a img').hover(function () {										  
        // SET OPACITY TO 100%
        jQuery(this).stop().animate({
            opacity: 0.75
        }, "fast");
    },	
    // ON MOUSE OUT
    function () {			
        // SET OPACITY BACK TO 50%
        jQuery(this).stop().animate({
            opacity: 1.0
        }, "fast");
    });
});
//Slider
// JavaScript Document
jQuery(window).load(function(){
    jQuery('#slides').slides({
        effect: 'fade',
        slideSpeed: 600,
        fadeSpeed:350,
        generateNextPrev: true,
        generatePagination: true,
        preload: true,
        preloadImage: 'img/loading.gif',
        play: 5000,
        pause: 2500,
        hoverPause: true,
        crossfade: true
    });
    jQuery( '#slides .pagination' ).wrap( '<div id="slider_pag" />' );
    jQuery( '#slides #slider_pag' ).wrap( '<div id="slider_nav" />' );
});
//DDsmooth
ddsmoothmenu.init({
    mainmenuid: "menu", //menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    //customtheme: ["#1c5a80", "#18374a"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
});
//Cufon replacement
Cufon.replace('h1')('h2')('h3')('h4')('h5')('h6');
	
jQuery(function() {    
    jQuery('.social_logo a').tipsy();
}); 
  
jQuery(function() { 
    jQuery('a.zoombox').zoombox();
});