$(function(){
    /* Variable to check if there is grid on the page and if there is initialize it */
    var gridElement = document.getElementById('bricklayer');

    if(gridElement){
        var bricklayer = new Bricklayer(gridElement);
    }

    /* Open mobile menu on click */
    $('.toggle-menu-button').click(function(e){
        $(this).toggleClass('show');
        $('.mobile .controls').toggleClass('show');
    });

    /* Close mobile menu on click */
    $('.controls-btn.close-btn').click(function(e){
        $('.toggle-menu-button').toggleClass('show');
        $('.mobile .controls').toggleClass('show');
    });

    /* Controlling the rotation of the arrow next to the filter button */
    $('#btn-work').find('.filter-button').click(function(e){
        $("#rotate-arrow").toggleClass('rotate');
        $('#desktop-filter-elements').toggleClass('show');

        var opacity = $( '#desktop-filter-elements' ).css( 'opacity' );

        if ( opacity == 0 ) {
            $('#btn-work').css({'z-index':'300'});
            $('#btn-about').css({'z-index':'300'});
        } else {
            setTimeout( function() {
                $('#btn-work').removeAttr('style');
                $('#btn-about').removeAttr('style');
            }, 350 );
        }

        var visibility = $( '#desktop-filter-elements img' ).css( 'visibility' );

        setTimeout( function() {
            if ( visibility == 'hidden' ) {
                $('#desktop-filter-elements img').css({visibility: 'inherit'}).fadeIn();
            }
            else {
                $('#desktop-filter-elements img').css({visibility: 'hidden'});
            }
        }, 450 );
    });

    /* Animation to show images and project containers based on scrolling in the page */
    if($('.project-item').length > 0){
        $('.project-item').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100
        });
    }

    /* Animation to show images and text based on scrolling in the project page */
    if($('.to-animate').length > 0){
        $('.to-animate').addClass("hidden").viewportChecker({
            classToAdd: 'visible animated fadeInUp',
            offset: 100
        });
    }

    /* Logic for switching the header text with project name when scrolled down on project page */
    if( $( 'body' ).hasClass( 'single-project') ){
        var x_text = $( '.icon-holder' ).html();
        $(window).on('scroll', function(e){
            var headerText = $('h1');
            var subHeader = $('.project-header');

            var mql = window.matchMedia( "screen and (max-width: 600px)" );
            var offset = 0;

            if ( mql.matches ) {
                offset = 83;
            }
            else {
                offset = 125;
            }

            if( $(window).scrollTop() > offset ){
                if($('.top-header-wrap').hasClass('show')){
                    headerText.html(subHeader.html().replace(/<p.*<\/p>/, ''));
                    $('.top-header-wrap').removeClass('show');
                }
            }else{
                if(!$('.top-header-wrap').hasClass('show')){
                    headerText.html('Franziska Veh');
                    $('.top-header-wrap').addClass('show');
                }
            }

            if ( $(window).scrollTop() ) {
                $( '.icon-holder' ).html('<br>');
            }
            else {
                $( '.icon-holder' ).html( x_text );
            }
        });

        $(window).trigger('scroll');
    }

    $( '.expand' ).click( function () {
        $( '.expandable').fadeToggle('down');
    });

    $( '.filter-element-item' ).hover( function() {
        $( this ).find( 'h5 .bottom-border' ).css( { width: "100%"} );
    }, function(){
        $( this ).find( '.bottom-border' ).css( "width", "0" );
    });

});
