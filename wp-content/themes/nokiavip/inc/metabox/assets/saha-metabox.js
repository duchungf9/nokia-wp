( function( $ ) {
	"use strict";

	$( document ).on( 'ready', function() {

		// Tabs
		$( 'div#saha-metabox ul.wp-tab-bar a').click( function() {
			var lis = $( '#saha-metabox ul.wp-tab-bar li' ),
				data = $( this ).data( 'tab' ),
				tabs = $( '#saha-metabox div.wp-tab-panel');
			$( lis ).removeClass( 'wp-tab-active' );
			$( tabs ).hide();
			$( data ).show();
			$( this ).parent( 'li' ).addClass( 'wp-tab-active' );
			return false;
		} );

		// Color picker
		$('div#saha-metabox .saha-mb-color-field').wpColorPicker();

		// Media uploader
		var _custom_media = true,
		_orig_send_attachment = wp.media.editor.send.attachment;

		$('div#saha-metabox .saha-mb-uploader').click(function(e) {
			var send_attachment_bkp	= wp.media.editor.send.attachment,
				button = $(this),
				id = button.prev();
			wp.media.editor.send.attachment = function(props, attachment){
				if ( _custom_media ) {
					$( id ).val( attachment.id );
				} else {
					return _orig_send_attachment.apply( this, [props, attachment] );
				};
			}
			wp.media.editor.open( button );
			return false;
		} );

		$( 'div#saha-metabox .add_media' ).on('click', function() {
			_custom_media = false;
		} );

		// Reset
		$( 'div#saha-metabox div.saha-mb-reset a.saha-reset-btn' ).click( function() {
			var confirm = $( 'div.saha-mb-reset div.saha-reset-checkbox' ),
				txt = confirm.is(':visible') ? "<?php echo __(  'Reset Settings', 'saha' ); ?>" : "<?php echo __(  'Cancel Reset', 'saha' ); ?>";
			$( this ).text( txt );
			$( 'div.saha-mb-reset div.saha-reset-checkbox input' ).attr('checked', false);
			confirm.toggle();
		});

		// Show hide title options
		var titleField = $( 'div#saha-metabox select#saha_disable_title' ),
			titleMainSettings = $( '#saha_title_style_tr'),
			titleStyleField = $( 'div#saha-metabox select#saha_title_style' ),
			titleStyleFieldVal = titleStyleField.val(),
			pageTitleBgSettings = $( '#saha_title_color_tr,#saha_title_font_size_tr,#saha_title_background_img_tr,#saha_title_height_tr,#saha_title_background_overlay_tr,#saha_title_background_overlay_opacity_tr');

		if ( titleField.val() === 'on' ) {
			titleMainSettings.hide();
			pageTitleBgSettings.hide();
		} else {
			titleMainSettings.show();
		}

		if ( titleStyleFieldVal === 'background-image' ) {
			pageTitleBgSettings.show();
		}

		titleField.change(function () {
			if ( $(this).val() === 'on' ) {
				titleMainSettings.hide();
				pageTitleBgSettings.hide();
			} else {
				titleMainSettings.show();
				var titleStyleFieldVal = titleStyleField.val();
				if ( titleStyleFieldVal === 'background-image' ) {
					pageTitleBgSettings.show();
				}
			}
		} );

		titleStyleField.change(function () {
			pageTitleBgSettings.hide();
			if ( $(this).val() == 'background-image' ) {
				pageTitleBgSettings.show();
			}
		} );


	} );

} ) ( jQuery );	