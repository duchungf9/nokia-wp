// Menus walker js

( function( $ ) {
	"use strict";
	$( document ).ready( function() {
		// show or hide megamenu fields on parent list items
		saha_megamenu.menu_item_mouseup();
		saha_megamenu.megamenu_update();
		saha_megamenu.update_megamenu_fields();
		saha_megamenu.custom_css_update();
		saha_megamenu.update_custom_css_fields();
		// setup automatic megamenu image
		$( '.saha-remove-image' ).manage_thumbnail_display();
		$( '.megamenu_image-image' ).css( 'display', 'block' );
		$( ".megamenu_image-image[src='']" ).css( 'display', 'none' );
		// setup new media uploader frame
		saha_media_frame_setup();
	});

	// Mega menu
	var saha_megamenu = {
		menu_item_mouseup: function() {
			$( document ).on( 'mouseup', '.menu-item-bar', function( event, ui ) {
				if( ! $( event.target ).is( 'a' )) {
					setTimeout( saha_megamenu.update_megamenu_fields, 300 );
				}
			});
		},

		megamenu_update: function() {
			$( document ).on( 'click', '.edit-menu-item-megamenu', function() {
				var parent_li_item = $( this ).parents( '.menu-item:eq( 0 )' );

				if( $( this ).is( ':checked' ) ) {
					parent_li_item.addClass( 'saha-megamenu' ).removeClass( 'saha-no-megamenu' );
				} else {
					parent_li_item.removeClass( 'saha-megamenu' ).addClass( 'saha-no-megamenu' );
				}

				saha_megamenu.update_megamenu_fields();
			});
		},

		update_megamenu_fields: function() {
			var menu_li_items = $('.menu-item');
			menu_li_items.each( function( i ) {
				var megamenu = $( '.edit-menu-item-megamenu', this );
				if( ! $( this ).is( '.menu-item-depth-0' ) ) {
					var check_against = menu_li_items.filter( ':eq(' + (i-1) + ')' );
					if( check_against.is( '.saha-megamenu' ) ) {
						megamenu.attr( 'checked', 'checked' );
						$( this ).addClass( 'saha-megamenu' ).removeClass( 'saha-no-megamenu' );
					} else {
						megamenu.attr( 'checked', '' );
						$( this ).removeClass( 'saha-megamenu' ).addClass( 'saha-no-megamenu' );
					}
				} else {
					if( megamenu.attr( 'checked' ) ) {
						$( this ).addClass( 'saha-megamenu' ).removeClass( 'saha-no-megamenu' );
					}
				}
			});
		},

		custom_css_update: function() {
			$( document ).on( 'click', '.edit-menu-item-custom_css', function() {
				var parent_li_item = $( this ).parents( '.menu-item:eq( 0 )' );

				if( $( this ).is( ':checked' ) ) {
					parent_li_item.addClass( 'saha-add-css' );
				} else {
					parent_li_item.removeClass( 'saha-add-css' );
				}

				saha_megamenu.update_custom_css_fields();
			});
		},

		update_custom_css_fields: function() {
			var menu_li_items = $('.menu-item');
			menu_li_items.each( function( i ) {
				var custom_css = $( '.edit-menu-item-custom_css', this );
				if( ! $( this ).is( '.menu-item-depth-0' ) ) {
					var check_against = menu_li_items.filter( ':eq(' + (i-1) + ')' );
					if( check_against.is( '.saha-add-css' ) ) {
						custom_css.attr( 'checked', 'checked' );
						$( this ).addClass( 'saha-add-css' );
					} else {
						custom_css.attr( 'checked', '' );
						$( this ).removeClass( 'saha-add-css' );
					}
				} else {
					if( custom_css.attr( 'checked' ) ) {
						$( this ).addClass( 'saha-add-css' );
					}
				}
			});
		}
	};

	$.fn.manage_thumbnail_display = function( variables ) {
		var button_id;
		return this.click( function( e ){
			e.preventDefault();
			button_id = this.id.replace( 'saha-media-remove-', '' );
			$( '#edit-menu-item-megamenu_image-'+button_id ).val( '' );
			$( '#saha-media-img-'+button_id ).attr( 'src', '' ).css( 'display', 'none' );
			$( '.custom-bg-'+button_id ).css( 'display', 'none' );
		});
	}

	function saha_media_frame_setup() {
		var saha_media_frame;
		var item_id;
		$( document.body ).on( 'click.sahaOpenMediaManager', '.saha-open-media', function(e){
			e.preventDefault();
			item_id = this.id.replace('saha-media-upload-', '');
			if ( saha_media_frame ) {
				saha_media_frame.open();
				return;
			}
			saha_media_frame = wp.media.frames.saha_media_frame = wp.media({
				className: 'media-frame saha-media-frame',
				frame: 'select',
				multiple: false,
				library: {
					type: 'image'
				}
			});
			saha_media_frame.on('select', function(){
				var media_attachment = saha_media_frame.state().get('selection').first().toJSON();
				$( '#edit-menu-item-megamenu_image-'+item_id ).val( media_attachment.url );
				$( '#saha-media-img-'+item_id ).attr( 'src', media_attachment.url ).css( 'display', 'block' );
				$( '.custom-bg-'+item_id ).css( 'display', 'inline-block' );
			});
			saha_media_frame.open();
		});
	}
})( jQuery );