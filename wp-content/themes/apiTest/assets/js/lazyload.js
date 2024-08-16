var lazy_elems = false;
var parallax_elems = false;
var webp = false;
var attr_images = 'data-lazy-srcset';
var w = false;

// SET WINDOW OBJECT VARIABLES
var set_window = function() {
	w = {
		'width'		: $(window).width(),
		'height'	: $(window).height()
	};
}

// VIDEO FUNCTIONS
	// SET BACKGROUND VIDEO
	var set_background_video = function(lazy_video_key) {
		var lazy_video_key = lazy_video_key;
		var interval;
		interval = setInterval(function(){
			if( YT.Player ) {
				interval = clearInterval(interval);
				if( ! window.youtubes[lazy_elems[lazy_video_key].elem.attr('id')] ) {
					window.youtubes[lazy_elems[lazy_video_key].elem.attr('id')] = new YT.Player( lazy_elems[lazy_video_key].elem.attr('id'), {
						videoId			: lazy_elems[lazy_video_key].elem.attr('data-youtube'),
						pauseOnScroll	: false,
						playerVars		: {
							autoplay		: 1,
							controls		: 0,
							disablekb		: 1,
							enablejsapi		: 1,
							fs				: 0,
							loop			: 1,
							modestbranding	: 1,
							playsinline		: 1,
							showinfo		: 0,
							autohide		: 1,
							rel				: 0
						},
						events			: {
							'onReady': function(e){
								$('#' + e.target.a.id).attr('data-width', e.target.a.width).attr('data-height', e.target.a.height);
								set_background_video_containers();
								window.youtubes[e.target.a.id].mute().playVideo();
								$('#' + e.target.a.id).addClass('loaded');
							},
							'onStateChange': function(e) {
								if( e.data === YT.PlayerState.ENDED ) {
									window.youtubes[e.target.a.id].playVideo();
								}
							}
						}
					});
				}
			}
		}, 50);
	}
	// VIDEO BACKGROUND CONTAINER POSITIONING
	var set_background_video_containers = function(){
		$('.video-background').each(function(){
	
			var $this = $(this);
			
			var video = {
				original	: {
					width : $(this).attr('data-width'),
					height : $(this).attr('data-height')
				},
				parent_elem	: {
					width : $(this).parent().outerWidth(),
					height : $(this).parent().outerHeight()
				}
			};

			var height = ( video.original.height * video.parent_elem.width ) / video.original.width;
			var width = ( video.original.width * video.parent_elem.height ) / video.original.height;

			if( height >= video.parent_elem.height ) {
				var offset = height - video.parent_elem.height;
				$this.width( video.parent_elem.width ).height( height ).css({ top: -( offset / 2 ), left: 0 });
			} else {
				var offset = width - video.parent_elem.width;
				$(this).width( width ).height( video.parent_elem.height ).css({ left: -( offset / 2 ), top: 0 });
			}
		})
	}


// LAZY FUNCTIONS
	// LAZY: DIVIDE PSEUDOELEMENT INTO USABLE PIECES
	var get_lazy_elem_sizes = function(lazy_elem_key){
		var sizes = [];
		
		if( ! lazy_elems[lazy_elem_key].elem.attr(attr_images) ) return false;

		$.each(lazy_elems[lazy_elem_key].elem.attr(attr_images).split(','), function(key, images) {

			var data = images.trim().split(" ");

			if( ! data[1] ) return false;
			var size = data[1].split('x');
	
			sizes.push({
				width	: parseInt( size[0] ),
				height	: parseInt( size[1] ),
				src		: data[0]
			});
		});
		lazy_elems[lazy_elem_key].sizes = sizes;
		return lazy_elems[lazy_elem_key].sizes;
	}
	
	// LAZY: SELECT THE APPROPRIATE IMAGE FOR THE CONTAINER WIDTH
	var get_current_lazy_image = function(lazy_elem_key) {
		
		if( lazy_elems[lazy_elem_key].elem.is('[data-lazy-contain]') ) {
			lazy_elems[lazy_elem_key].elem.removeAttr('style');
			var aspect_ratio = lazy_elems[lazy_elem_key].sizes[ lazy_elems[lazy_elem_key].sizes.length - 1 ];
			var max = {
				'width' 	: parseInt( lazy_elems[lazy_elem_key].elem.css('max-width').replace(/\D/g,'') ),
				'height'	: parseInt( lazy_elems[lazy_elem_key].elem.css('max-height').replace(/\D/g,'') )
			};

			if( ( ( max.width * aspect_ratio.height ) / aspect_ratio.width ) > max.height ) {
				lazy_elems[lazy_elem_key].set = 'height';
				lazy_elems[lazy_elem_key].elem.css('height', max.height );
			} else {
				lazy_elems[lazy_elem_key].set = 'width';
				lazy_elems[lazy_elem_key].elem.css('width', max.width );
			}
		}
		
		var elem_width = lazy_elems[lazy_elem_key].elem.width();
		
		var rate = lazy_elems[lazy_elem_key].elem.attr('data-lazy-rate') ? parseFloat( lazy_elems[lazy_elem_key].elem.attr('data-lazy-rate') ) : 1;

		for( var i = 0; i < lazy_elems[lazy_elem_key].sizes.length; i++ ){
			if( lazy_elems[lazy_elem_key].sizes[i].width >= ( elem_width * rate ) ) {
				set_lazy_aspect_ratio( lazy_elem_key, lazy_elems[lazy_elem_key].sizes[i] );
				lazy_elems[lazy_elem_key].image = lazy_elems[lazy_elem_key].sizes[i].src;
				return lazy_elems[lazy_elem_key].image;
			}
		}
		set_lazy_aspect_ratio( lazy_elem_key, lazy_elems[lazy_elem_key].sizes[(lazy_elems[lazy_elem_key].sizes.length - 1)] );
		lazy_elems[lazy_elem_key].image = lazy_elems[lazy_elem_key].sizes[(lazy_elems[lazy_elem_key].sizes.length - 1)].src;
		return lazy_elems[lazy_elem_key].image;
	}
	
	// SET ASPECT RATIO TYPE
	var get_current_lazy_set = function(lazy_elem_key) {
		if( lazy_elems[lazy_elem_key].type == 'background' || lazy_elems[lazy_elem_key].elem.attr('data-lazy-set') == 'none' ) {
			lazy_elems[lazy_elem_key].set = 'none'
		} else if( lazy_elems[lazy_elem_key].elem.attr('data-lazy-set') == 'height' ) {
			lazy_elems[lazy_elem_key].set = 'height';
		} else {
			lazy_elems[lazy_elem_key].set = 'width';			
		}
		return lazy_elems[lazy_elem_key].set;
	}
		
	// SET LAZY HEIGHT OF THE ELEMENT TO PREVENT PAGE FROM GETTING BUMPED DOWN ON LOAD
	var set_lazy_aspect_ratio = function(lazy_elem_key, size) {
		if( lazy_elems[lazy_elem_key].type != 'background' && lazy_elems[lazy_elem_key].set == 'width' ) {
			lazy_elems[lazy_elem_key].elem.height( ( lazy_elems[lazy_elem_key].elem.width() * size.height ) / size.width );
		} else if( lazy_elems[lazy_elem_key].set == 'height' ) {
			lazy_elems[lazy_elem_key].elem.width( ( lazy_elems[lazy_elem_key].elem.height() * size.width ) / size.height );
		}
	}
	
	// GET LAZY OFFSET WHEN THE IMAGE SHOULD LOAD
	var get_lazy_current_offset = function(lazy_elem_key) {
		var offset = lazy_elems[lazy_elem_key].elem.attr('data-lazy-offset') ? parseInt( lazy_elems[lazy_elem_key].elem.attr('data-lazy-offset') ) : -100;
		lazy_elems[lazy_elem_key].offset_top = lazy_elems[lazy_elem_key].elem.offset().top + offset;
		return lazy_elems[lazy_elem_key].offset_top;
	}
	
	// GET LAZY ELEMENTS
	var get_lazy_elem_type = function(lazy_elem_key) {
		if( lazy_elems[lazy_elem_key].elem.is('img') ) {
			lazy_elems[lazy_elem_key].type = 'image';
		} else if( lazy_elems[lazy_elem_key].elem.is('.youtube-embed') || lazy_elems[lazy_elem_key].elem.attr('data-lazy-type') == 'video' ) {
			lazy_elems[lazy_elem_key].type = 'video';
		} else if( lazy_elems[lazy_elem_key].elem.is('.background-load') || lazy_elems[lazy_elem_key].elem.attr('data-lazy-type') == 'background-image' ) {
			lazy_elems[lazy_elem_key].type = 'background';
		} else if( lazy_elems[lazy_elem_key].elem.attr('data-lazy-type') == 'svg-data' ) {
			lazy_elems[lazy_elem_key].type = 'svg-data';
		}
		return lazy_elems[lazy_elem_key].type;
	}
	
	// GET LAZY VISIBILITY
	var get_lazy_current_visible = function(lazy_elem_key) {
		lazy_elems[lazy_elem_key].visible = lazy_elems[lazy_elem_key].elem.is(':visible')
		return lazy_elems[lazy_elem_key].visible;
	}
	
	// SET LAZY ELEMENT CONTENT
	var set_content = function(lazy_elem_key){
		if( lazy_elems[lazy_elem_key].type == 'background' ) {
			$(lazy_elems[lazy_elem_key].elem).css('background-image', 'url(' + lazy_elems[lazy_elem_key].image + ')').addClass('loaded');
		} else if( lazy_elems[lazy_elem_key].type == 'image' ) {
			$(lazy_elems[lazy_elem_key].elem).attr('src', lazy_elems[lazy_elem_key].image).bind('load', function () {
				$(this).addClass('loaded');
			});
		} else if( lazy_elems[lazy_elem_key].type == 'video' ) {
			set_background_video(lazy_elem_key);
		} else if( lazy_elems[lazy_elem_key].type == 'svg-data' ) {
			var $lazy_svg_wrap = lazy_elems[lazy_elem_key].elem;
			$.ajax({
				url: lazy_elems[lazy_elem_key].image,
				dataType: 'html',
				type: 'GET',
			})
			.done(function( data ) {
				$lazy_svg_wrap.html(data).addClass('loaded');
			});
		}
	}
		
	// REFLOW/UPDATE POSITION AND IMAGE BY KEY
	var lazy_reflow = function(lazy_elem_key) {
	
		// GET THE CURRENT APPROPRIATE LAZY IMAGE
		lazy_elems[lazy_elem_key].image = get_current_lazy_image( lazy_elem_key );
		
		// GET VISIBILITY
		lazy_elems[lazy_elem_key].visible = get_lazy_current_visible( lazy_elem_key );
		
		// IF ANOTHER IMAGE HAS ALREADY BEEN LOADED, SWAP IT OUT
		if( lazy_elems[lazy_elem_key].loaded && $(lazy_elems[lazy_elem_key].elem).attr('src') != lazy_elems[lazy_elem_key].image && lazy_elems[lazy_elem_key].visible ) {
			set_content(lazy_elem_key);
		}
		
		// GET THE NEW OFFSET OF THIS ELEMENT
		lazy_elems[lazy_elem_key].offset_top = get_lazy_current_offset(lazy_elem_key);
	}
	
	// REFLOW/UPDATE ALL POSITIONS AND IMAGES
	var lazy_reflow_all = function(){
		for( var i = 0; i < lazy_elems.length; i++ ) {
			lazy_reflow(i);
		}
	}

	var get_lazy_elem = function( $this ){
		key = lazy_elems.length;
		
		lazy_elems[key] = {
			elem		: $this,
			loaded		: false
		};
		
		lazy_elems[key].type = get_lazy_elem_type(key);
		lazy_elems[key].sizes = get_lazy_elem_sizes(key);
		
		if( lazy_elems[key].sizes ) {
			$this.attr('data-lazy-key', key);
			lazy_elems[key].set = get_current_lazy_set(key);
			lazy_elems[key].image = get_current_lazy_image(key);
			lazy_elems[key].offset_top = get_lazy_current_offset(key);
			lazy_elems[key].visible = get_lazy_current_visible(key);
		} else {
			// DELETE MALFORMED KEYS
			lazy_elems.splice(key, 1);
		}
	}

	
	// INITIAL PREPERATION OF ELEMENTS
	var get_lazy_elems = function(){
		if( ! lazy_elems ) {
			lazy_elems = [];
			$('.lazy-load').each(function(lazy_key, value){
				get_lazy_elem( $(this) );
			});
		}
	}
	
	// ADD NEW LAZY ELEMS DYNAMICALLY
	var get_new_lazy_elems = function(){
		$('.lazy-load').each(function(lazy_key, value){
			if( ! $(this).attr('data-lazy-key') ) {
				get_lazy_elem( $(this) );
			}
		});
	}	

// PARALLAX
	var get_parallax_elems = function(){
		if( ! parallax_elems ) {
			parallax_elems = [];
			$('[data-parallax]').each(function(key, value){
				$(this).attr('data-parallax-key', key);
				parallax_elems[key] = {
					elem		: $(this),
					offset_top	: $(this).offset().top,
					offset_bot	: $(this).offset().top + $(this).outerHeight(),
					height		: $(this).outerHeight(),
					visible		: $(this).is(':visible'),
					fn			: $(this).attr('data-parallax-fn')
				};
				eval( $(this).attr('data-parallax-reflow') + '(' + key + ')' );
			});
		}
	}
	
	var parallax_reflow_all = function() {
		if( parallax_elems ) {
			for( i = 0; i < parallax_elems.length; i++ ) {
				parallax_elems[i].offset_top = parallax_elems[i].elem.offset().top;
				parallax_elems[i].offset_bot = parallax_elems[i].elem.offset().top + parallax_elems[i].elem.outerHeight();
				parallax_elems[i].height = parallax_elems[i].elem.outerHeight();
				parallax_elems[i].visible = parallax_elems[i].elem.is(':visible');
				eval( parallax_elems[i].elem.attr('data-parallax-reflow') + '(' + i + ')' );
			}
		}
	}


$(document).ready(function(){
	set_window();
	set_background_video_containers();
	get_lazy_elems();
	get_parallax_elems();
/*
	supports_webp(function(webp){
		attr_images = webp ? 'data-images' : 'data-images-fallback';
		if( ! webp ) {
			for(i = 0; i < lazy_elems.length; i++){
				$(lazy_elems[i].elem).attr('src', $(lazy_elems[i].elem).attr('data-preview-fallback'));
			};
		}
		get_lazy_elems();
		get_sections();
*/
		
		$(window).on('scroll', function(e){
			var scroll_top = $(this).scrollTop();
			var page_bottom = scroll_top + w.height;
			if( lazy_elems ) {
				for(i = 0; i < lazy_elems.length; i++){
					if( lazy_elems[i].visible && ! lazy_elems[i].loaded && lazy_elems[i].offset_top <= page_bottom ) {
						set_content(i);
						lazy_elems[i].loaded = true;
					};
				};
			};
			if( parallax_elems ) {
				for(i = 0; i < parallax_elems.length; i++){
					if( parallax_elems[i].visible && parallax_elems[i].offset_top <= page_bottom && ( parallax_elems[i].offset_bot - scroll_top ) > 0 ) {
						percent = ( page_bottom - parallax_elems[i].offset_top ) / ( w.height + parallax_elems[i].height );
						eval( parallax_elems[i].fn + '(' + i + ',' + percent +')' );
					};
				};
			}
		}).trigger('scroll').trigger('resize');
// 	});
});

$(window).on('load', function(){
	$(window).trigger('resize');
});

$(window).on('resize', function(){
	set_window();
	set_background_video_containers();
	lazy_reflow_all();
	parallax_reflow_all();

	$(window).trigger('scroll');
});