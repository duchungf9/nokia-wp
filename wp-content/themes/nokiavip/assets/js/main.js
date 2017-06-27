var $ = jQuery.noConflict();

$(document).ready(function() {
	"use strict";
    // Fixed header
    fixedHeader();
    // Menu scripts
    menuScripts();
    // Yith search
    yithAjaxSearch();
    // Yith wishlist loader
    initWishlist();
    // Yith compare loader
    initCompare();
    // Woo switcher
    wooSwitcher();
    // Woo quick view
    wooQuickView();
    // Woo image zoom
    wooZoom();
    // Woo add to cart
    wooAddToCart();
    // Woo quantity
    wooQuantity();
    // Woo categories widget
    wooCategoriesWidget();
    // Local scroll
    localScroll();
    // Magnific popup
    initMagnificPopup();
    // Carousel
    initCarousel();
	// Responsive video
	fitVideo();
    // Icon box widget
    iconBoxWidget();
    // Tabs widget
    tabsWidget();
    // Selectbox
    initSelectbox();
    // Tooltip
    initTooltip();
    // init animate scroll
    initWow();
    // Scroll top
    scrollTop();
});

/* ==============================================
FIXED HEADER
============================================== */
function fixedHeader() {
    "use strict"

    $(window).scroll(function(){
        var fixedHeader     = $('.fixed-header');
        var scrollTop       = $(this).scrollTop();
        var headerHeight    = $('.site-header').height() + 20;
        
        if ( scrollTop > headerHeight ) {
            if ( !fixedHeader.hasClass('fixed-already') ) {
                fixedHeader.stop().addClass('fixed-already');
            }
        } else {
            if ( fixedHeader.hasClass('fixed-already') ) {
                fixedHeader.stop().removeClass('fixed-already');
            }
        }
    });

}

/* ==============================================
MENU SCRIPTS
============================================== */
function menuScripts() {
    "use strict"

    // Superfish menu
    $('ul.sf-menu').superfish({
        delay: 300,
        animation: {opacity:'show'},
        speed: 500,
        cssArrows: false
    });

    // Megamenu
    $('.dropdown-menu li.megamenu-menu').hover(function(){
        var menuWidth           = $('#site-navigation-wrap div.container').width(),
            menuPosition        = $('#site-navigation-wrap div.container').offset(),     
            menuItemPosition    = $(this).offset(),
            PositionLeft        = menuItemPosition.left-menuPosition.left+1;
        $(this).find('.megamenu').css({ left: '-'+PositionLeft+'px', width: menuWidth });
    });

    // Megamenu auto width
    $('.main-navigation .mega-auto-width > .megamenu').each(function() {
        var li                  = $(this).parent();
        var liOffset            = li.offset().left;
        var liOffsetTop         = li.offset().top;
        var liWidth             = $(this).parent().width();
        var dropdowntMarginLeft = liWidth/2;
        var dropdownWidth       = $(this).outerWidth();
        var dropdowntLeft       = liOffset - dropdownWidth/2;
        
        if(dropdowntLeft < 0) {
            var left            = liOffset - 10;
            dropdowntMarginLeft = 0;
        } else {
            var left            = dropdownWidth/2;
            
        }
        
        if($('body').hasClass('rtl')) {
            $(this).css({
                'right': - left,
                'marginRight': dropdowntMarginLeft
            });
        } else {
            $(this).css({
                'left': - left,
                'marginLeft': dropdowntMarginLeft
            });
        }
        
        var dropdownRight = ($(window).width()) - (liOffset - left + dropdownWidth + dropdowntMarginLeft);
        
        if(dropdownRight < 0) {
            $(this).css({
                'left': 'auto',
                'right': - ($(window).width() - liOffset - liWidth - 10)
            });
        }
        
    });

    // Header fixed search link
    $('.fixed-header li a.search-link').on('click', function( ev ){
        ev.preventDefault();
    });

    // Mobile menu
    $('.mobile-link a').on('click', function( ev ){
        ev.preventDefault();
        ev.stopPropagation();
        $('html').addClass('open-mobile-nav');
    });

    $('.mobile-nav .close-mobile-nav, #page').on('click', function(){
        $('html').removeClass('open-mobile-nav');
    });

    // wpml
    $('.mobile-nav ul li.menu-item-language ul.sub-menu').parent('li').addClass('has-sub').prepend('<span class="mobile-icon plus"></span>');

    $('.mobile-nav ul li.has-sub .mobile-icon, .mobile-nav ul li.has-sub a[href*=#], .mobile-nav ul li.menu-item-language.has-sub .mobile-icon').on('click', function( ev ){
        ev.preventDefault();
        if ($(this).closest('li.has-sub').find('> ul.sub-menu').is(':visible')){
            $(this).closest('li.has-sub').find('> ul.sub-menu').slideUp(200);
            $(this).closest('li.has-sub').removeClass('open-sub');
        } else {
            $(this).closest('li.has-sub').addClass('open-sub');
            $(this).closest('li.has-sub').find('> ul.sub-menu').slideDown(200);
        }
    });

}

/* ==============================================
YITH AJAX SEARCH
============================================== */
function yithAjaxSearch() {
	"use strict"

	// Ajax
	if ( $.fn.yithautocomplete ) {

        var loader_url 			= woocommerce_params.ajax_loader_url;

        var ajax_search 		= $('#yith-s'),
            loader_icon 		= ajax_search.data('loader-icon') == '' ? loader_url : ajax_search.data('loader-icon'),
            min_chars 			= ajax_search.data('min-chars'),
            search_categories 	= $('#search_categories');

        ajax_search.yithautocomplete({
            minChars: min_chars,
            appendTo: '.yith-ajaxsearchform-container .nav-searchfield',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function () {
                $(this).css('background', 'url(' + loader_icon + ') no-repeat 99% center');
            },
            onSearchComplete: function () {
                $(this).css('background', 'transparent');
            },
            onSelect: function (suggestion) {
                if (suggestion.id != -1) {
                    window.location.href = suggestion.url;
                }
            },

            formatResult: function (suggestion, currentValue) {

                var pattern = '(' + $.YithAutocomplete.utils.escapeRegExChars(currentValue) + ')';
                var html = '';

                if( $('.yith-search-premium').length ){

                    if ( typeof suggestion.img !== 'undefined' ) {
                        html += suggestion.img;
                    }
                    html += '<div class="yith_wcas_result_content">';
                    html += suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');

                    if ( typeof suggestion.div_badge_open !== 'undefined' ) {
                        html += suggestion.div_badge_open;
                    }

                    if ( typeof suggestion.on_sale !== 'undefined' ) {
                        html += suggestion.on_sale;
                    }

                    if ( typeof suggestion.featured !== 'undefined' ) {
                        html += suggestion.featured;
                    }

                    if ( typeof suggestion.div_badge_close !== 'undefined' ) {
                        html += suggestion.div_badge_close;
                    }

                    if ( typeof suggestion.excerpt !== 'undefined' ) {
                        html += ' ' + suggestion.excerpt.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
                    }

                    if ( typeof suggestion.price !== 'undefined' ) {
                        html += ' ' + suggestion.price;
                    }
                    html += '</div>';
                }else{
                    var html = suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');

                    if ( typeof suggestion.price !== 'undefined' ) {
                        html += ' ' + suggestion.price;
                    }

                    if ( typeof suggestion.img !== 'undefined' ) {
                        html += suggestion.img;
                    }
                }

                return html;
            }
        });

        // categories select
        search_categories.selectbox({
            effect: 'fade',
            onOpen: function() {
            }
        });

        if( search_categories.length ){
            search_categories.on( 'change', function( e ){
                var ac = ajax_search.yithautocomplete();

                if( search_categories.val() != '' ) {
                    ac.setOptions({
                        serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products&product_cat=' + search_categories.val()
                    });
                }else{
                    ac.setOptions({
                        serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products'
                    });
                }

                // update suggestions
                ac.hide();
                ac.onValueChange();
            });
        }
    }

}

/* ==============================================
YITH WISHLIST LOADER
============================================== */
function initWishlist() {
    "use strict"

    $('.add_to_wishlist').on( 'click', function( ev ) {
        ev.preventDefault();

        var el          = $(this),
            product_id  = el.data( 'product-id' );

        $.ajax({
            type: 'POST',
            url: yith_wcwl_l10n.ajax_url,
            dataType: 'json',

            beforeSend: function(){
                el.removeClass( 'adding-to-wishlist added-to-wishlist' ).addClass( 'adding-to-wishlist' );
            },

            complete: function(){
                el.removeClass( 'adding-to-wishlist added-to-wishlist' ).addClass( 'added-to-wishlist' );
            }
        });
    });

}

/* ==============================================
YITH COMPARE LOADER
============================================== */
function initCompare() {
    "use strict"

    $('.product a.compare:not(.added)').on( 'click', function( ev ) {
        ev.preventDefault();

        var el          = $(this),
            product_id  = el.data( 'product_id' );

        $.ajax({
            type: 'POST',
            url: yith_woocompare.ajax_url,
            dataType: 'html',

            beforeSend: function() {
                el.removeClass( 'adding-to-compare added-to-compare' ).addClass( 'adding-to-compare' );
                el.append('<div class="loader-wrapper ajax-loading"><svg class="loader" viewBox="0 0 50 50"><circle class="path" cx="25" cy="25" r="20"></circle></svg></div>');
            },

            complete: function() {
                el.removeClass( 'adding-to-compare added-to-compare' ).addClass( 'added-to-compare' );
                el.find('.loader-wrapper').remove();
            }
        });
    });

}

/* ==============================================
WOOCOMMERCE SWITCHER
============================================== */
function wooSwitcher() {
    "use strict"

    $('.saha-switcher a').on('click', function( ev ) {
        ev.preventDefault();

        var mode = $(this).data('mode');

        if ( $(this).hasClass('active') ) {
            return false;
        }

        $('.saha-switcher a').removeClass('active');

        $('.saha-switcher a').each(function(){
            if ( $(this).hasClass(mode) ) {
                $(this).addClass('active');
            }
        });
        
        if ( $('.products').hasClass('grid') ) {
            $('.products').removeClass('grid');
            $('.products').addClass('list');
        } else if ( $('.products').hasClass('list') ) {
            $('.products').removeClass('list');
            $('.products').addClass('grid');
        }
    });

}

/* ==============================================
WOOCOMMERCE IMAGE ZOOM
============================================== */
function wooZoom() {
    "use strict"

    if ( $(window).width() > 768 ) {
        $('.singular-product div.product .main-images .product-image').swinxyzoom({
            mode:'window',
            controls: false,
            size: '100%',
            dock: { position: 'right' }
        });
    }

}

/* ==============================================
WOOCOMMERCE QUICK VIEW
============================================== */
function wooQuickView() {
    "use strict"

    $(document.body).on('click', '.action-button li a.quick', (function( ev ) {
        ev.preventDefault();
        
        var $thisbutton     = $(this),
            prodid          = $thisbutton.data('prodid'),
            product_url     = $('.product-image > a').attr('href'),
            $productCont    = $('.products .post-'+prodid+' .product-image > a'),
            magnificPopup;

        $.ajax({
            url: woocommerce_params.ajax_url,
            method: 'POST',
            data: {
                'action': 'saha_product_quick_view',
                'prodid': prodid
            },
            dataType: 'html',

            beforeSend: function() {
                $productCont.append('<span class="quick-loading"><i class="fa fa-spinner"></i></span>');
            },

            complete: function() {
                $productCont.find('.quick-loading').remove();
            },

            success: function(response){

                $.magnificPopup.open({
                    items: { src: '<div class="quick-view-popup modal zoom-anim-dialog"><div class="modal-dialog clr">' + response + '</div></div>' },
                    type: 'inline',
                    midClick: true,
                    removalDelay: 300,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'my-mfp-slide-bottom effect-rotate';
                        }
                    }
                }, 0);

                $('.variations_form').wc_variation_form();
                $('.variations_form .variations select').change();

                // Quantity fields
                $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<div class="qty-changer"><a href="javascript:void(0)" class="plus"><i class="fa fa-angle-up"></i></a><a href="javascript:void(0)" class="minus"><i class="fa fa-angle-down"></i></a></div>');

                // Wishlist button
                initWishlist();

                // Compare button
                initCompare();

                // Add to cart
                $('.quick-view-popup form.cart').on('submit', function ( ev ) {
                    ev.preventDefault();

                    if( typeof wc_cart_fragments_params != 'undefined' && wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                        window.location = wc_add_to_cart_params.cart_url;
                        return;
                    }

                    $('.product.post-'+prodid+' .cart-loading').addClass('in_cart');
                    $('.product.post-'+prodid+' .cart-loading i').removeClass('icon-check').addClass('fa fa-spinner');

                    setTimeout(function() {
                        $('.product.post-'+prodid+' .cart-loading i').removeClass('fa fa-spinner').addClass('icon-check');
                    }, 800);

                    var form = $(this);

                    $.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result) {
                        var message         = $('.woocommerce-message', result),
                            cart_dropdown   = $('.site-header-inner .header-cart', result);

                        if( typeof wc_cart_fragments_params != 'undefined') {
                            // update fragments
                            var $supports_html5_storage;

                            try {
                                $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );

                                window.sessionStorage.setItem('wc', 'test');
                                window.sessionStorage.removeItem('wc');
                            } catch (err) {
                                $supports_html5_storage = false;
                            }

                            $.ajax({
                                url    : wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                                type   : 'POST',
                                success: function (data) {

                                    if (data && data.fragments) {

                                        $.each(data.fragments, function (key, value) {
                                            $(key).replaceWith(value);
                                        });

                                        if ($supports_html5_storage) {
                                            sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(data.fragments));
                                            sessionStorage.setItem('wc_cart_hash', data.cart_hash);
                                        }

                                        $(document.body).trigger('wc_fragments_refreshed');
                                    }
                                }
                            });
                        }
                    });
                });
            },

            error: function() {
                $.magnificPopup.open({
                    items: {
                        src: '<div class="quick-view-popup modal zoom-anim-dialog"><div class="modal-dialog clr">Error with AJAX request</div></div>'
                    },
                    type: 'inline',
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'my-mfp-slide-bottom effect-rotate';
                        }
                    }
                }, 0);
            }
        });

    }));

}

/* ==============================================
WOOCOMMERCE ADD TO CART
============================================== */
function wooAddToCart() {
    "use strict"

    $('.product-details a.add_to_cart_button').on('click', function(){
        var product_id = $(this).attr( 'data-product_id' );

        $('.products .post-'+product_id+' .cart-loading').addClass('in_cart');
        $('.products .post-'+product_id+' .cart-loading i').removeClass('icon-check').addClass('fa fa-spinner');

        setTimeout(function() {
            $('.products .post-'+product_id+' .cart-loading i').removeClass('fa fa-spinner').addClass('icon-check');
        }, 800);
    });

}

/* ==============================================
LOCAL SCROLL
============================================== */
function localScroll() {
    "use strict"

    $('.local-scroll, .singular-post a.comments-link, a.woocommerce-review-link').on( 'click', function( ev ) {
        ev.preventDefault();

        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname ) {
            var target          = $(this.hash);
            var headerHeight    = $('.site-header').height();

            if ( target.length ) {
                $('html, body').animate({
                    scrollTop: target.offset().top - headerHeight
                }, 1000);
                return false;
            }
        }
    });

}

/* ==============================================
WOOCOMMERCE QUANTITY
============================================== */
function wooQuantity() {
    "use strict"

    $('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').append('<div class="qty-changer"><a href="javascript:void(0)" class="plus"><i class="fa fa-angle-up"></i></a><a href="javascript:void(0)" class="minus"><i class="fa fa-angle-down"></i></a></div>');

    // Target quantity inputs on product pages
    $( 'input.qty:not(.product-quantity input.qty)' ).each( function() {
        var min = parseFloat( $( this ).attr( 'min' ) );

        if ( min && min > 0 && parseFloat( $( this ).val() ) < min ) {
            $( this ).val( min );
        }
    });

    $( document ).on( 'click', '.plus, .minus', function() {

        // Get values
        var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
            currentVal  = parseFloat( $qty.val() ),
            max         = parseFloat( $qty.attr( 'max' ) ),
            min         = parseFloat( $qty.attr( 'min' ) ),
            step        = $qty.attr( 'step' );

        // Format values
        if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
        if ( max === '' || max === 'NaN' ) max = '';
        if ( min === '' || min === 'NaN' ) min = 0;
        if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

        // Change the value
        if ( $( this ).is( '.plus' ) ) {

            if ( max && ( max == currentVal || currentVal > max ) ) {
                $qty.val( max );
            } else {
                $qty.val( currentVal + parseFloat( step ) );
            }

        } else {

            if ( min && ( min == currentVal || currentVal < min ) ) {
                $qty.val( min );
            } else if ( currentVal > 0 ) {
                $qty.val( currentVal - parseFloat( step ) );
            }

        }

        // Trigger change event
        $qty.trigger( 'change' );
    });

}

/* ==============================================
WOOCOMMERCE CATEGORIES WIDGET
============================================== */
function wooCategoriesWidget() {
    "use strict"

    $('.product-categories').each(function() {
        $(this).find('li').has('.children').has('li').prepend('<div class="open-this"><i class="fa fa-angle-down"></i></div>');

        $(this).find('.open-this').on('click', function(){
            if ( $(this).parent().hasClass('opened') ) {
                $(this).parent().removeClass('opened').find('> ul').slideUp(200);
            } else {
                $(this).parent().addClass('opened').find('> ul').slideDown(200);
            }
        });
    });

}

/* ==============================================
MAGNIFIC POPUP
============================================== */
function initMagnificPopup() {
    "use strict"

    // Lightbox
    $('.sh-lightbox').magnificPopup({
        type: 'image',
        image:{
            cursor: 'mfp-zoom-out-cur',
            titleSrc: 'title',
            verticalFit: true
        },
        mainClass: 'mfp-fade'
    });

    // Gallery lightbox
    $('.gallery-lightbox').magnificPopup({
        type:'image',
        gallery:{
            enabled: true,
            tPrev: 'Previous',
            tNext: 'Next',
        },
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        callbacks: {
            beforeOpen: function() {
                this.st.mainClass = 'my-mfp-slide-bottom effect-rotate';
            }
        }
    });

}

/* ==============================================
CAROUSEL
============================================== */
function initCarousel() {
    "use strict"

    // Gallery posts
    $('.gallery-format').owlCarousel({
        singleItem: true,
        navigation : true,
        navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
        slideSpeed : 300,
        pagination: false,
        autoPlay: 7000,
        stopOnHover: true,
    });

    // Brand widget
    var slider      = $('.saha-brand'),
        navigation  = slider.data('navigation'),
        items       = slider.data('items');

    slider.owlCarousel({
        items: items,
        itemsDesktop : [1199,items],
        itemsDesktopSmall : [991,3],
        itemsTablet: [640,3],
        itemsMobile : [480,1],
        navigation : navigation,
        navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
        pagination: false,
    });

    // Slider widget
    var slider      = $('.saha-slider'),
        navigation  = slider.data('navigation'),
        dots        = slider.data('dots'),
        slideshow   = slider.data('slideshow');

    slider.owlCarousel({
        singleItem: true,
        navigation : navigation,
        navigationText: ['<span class="fa fa-angle-left"></span>','<span class="fa fa-angle-right"></span>'],
        slideSpeed : slideshow,
        pagination: dots,
        autoPlay: 7000,
        stopOnHover: true,
    });

    // Testimonials widget
    var slider      = $('.testimonials-slider'),
        slideshow   = slider.data('slideshow');

    slider.owlCarousel({
        singleItem: true,
        navigation : false,
        slideSpeed : slideshow,
        pagination: true,
        autoPlay: 7000,
        stopOnHover: true,
    });

}

/* ==============================================
RESPONSIVE VIDEOS
============================================== */
function fitVideo() {
	"use strict"

	$(".responsive-video-wrap").fitVids();

}

/* ==============================================
ICON BOX WIDGETS
============================================== */
function iconBoxWidget() {
    "use strict"

    $('.saha-box-inner.icon-colored').hover( function() {
        var icon = $(this).find('.saha-icon');

        if ( typeof icon.attr('data-hover-bg') !== "undefined" ) {
            icon.css({
                'background-color': icon.attr('data-hover-bg')
            });
        }

        if ( typeof icon.attr('data-hover-color') !== "undefined" ) {
            icon.css({
                'color': icon.attr('data-hover-color')
            });
        }

        if ( typeof icon.attr('data-hover-border-color') !== "undefined" ) {
            icon.css({
                'border-color': icon.attr('data-hover-border-color')
            });
        }
    }, function() {
        var icon = $(this).find('.saha-icon');

        if ( typeof icon.attr('data-bg') !== "undefined" ) {
            icon.css({
                'background-color': icon.attr('data-bg')
            });
        }

        if ( typeof icon.attr('data-color') !== "undefined" ) {
            icon.css({
                'color': icon.attr('data-color')
            });
        }

        if ( typeof icon.attr('data-border-color') !== "undefined" ) {
            icon.css({
                'border-color': icon.attr('data-border-color')
            });
        }
    });

}

/* ==============================================
TABS WIDGETS
============================================== */
function tabsWidget() {
    "use strict"

    var tabs = $(".tabs-widget .tab-content");
        tabs.hide();

    $(".tabs-widget ul.tabs-nav > li:first").addClass("active").show();
    $(".tabs-widget .tab-content:first").show();

    $(".tabs-widget ul.tabs-nav > li").on('click', function(){
        $(".tabs-widget ul.tabs-nav > li").removeClass("active");
        $(this).addClass("active");
        tabs.hide();
        var activeTab = $(this).find("a").attr("href");
        $(activeTab).slideDown();
        
        return false;
    });

}

/* ==============================================
SELECTBOX
============================================== */
function initSelectbox() {
    "use strict"

    $('form.woocommerce-ordering select, form.woocommerce-shipping-calculator select, .woocommerce-account form select').selectbox({
        effect: 'fade'
    });

}

/* ==============================================
TIPSY
============================================== */
function initTooltip() {
    "use strict"

    $('.tooltip-up').tipsy({fade: true, gravity: 's'});
    $('.tooltip-up-right').tipsy({fade: true, gravity: 'sw'});
    $('.tooltip-up-left').tipsy({fade: true, gravity: 'se'});
    $('.tooltip-down').tipsy({fade: true, gravity: 'n'});
    $('.tooltip-down-right').tipsy({fade: true, gravity: 'nw'});
    $('.tooltip-down-left').tipsy({fade: true, gravity: 'ne'});
    $('.tooltip-left').tipsy({fade: true, gravity: 'e'});
    $('.tooltip-right').tipsy({fade: true, gravity: 'w'});

    $('.flickr-widget .flickr_badge_image a img').tipsy({fade: true, gravity: 's'});

}

/* ==============================================
INIT ANIMATE SCROOL
============================================== */
function initWow() {
    "use strict"

    var wow;
    if( $('.saha_effect').hasClass('wow') ){
        wow = new WOW(
            {
                mobile : false,
            }
        );
        wow.init();
    }

}

/* ==============================================
SCROLL TOP
============================================== */
function scrollTop() {
	"use strict"
	
	var selectors  = {
		scrollTop  : '#scroll-top',
		topLink    : 'a[href="#go-top"]'
	}

	$(window).on("scroll", function() {
		if ($(this).scrollTop() > 100) {
			$('#scroll-top').fadeIn();
		} else {
			$('#scroll-top').fadeOut();
		}
	});

	$.each(selectors, function(key, value){
		$(value).on('click', function(){
			$('html, body').animate({scrollTop:0}, 400);
			$(this).parent().removeClass('sfHover');
		});
	});

}