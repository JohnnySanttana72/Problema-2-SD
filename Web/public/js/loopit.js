/*
* Loopit -- Responsive jQuery Image Slider  
* https://github.com/Johntaa/loopit
* Copyright 2015, Johntaa
* Free to use and abuse under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
*/

(function ($) {
	function LoopIt(elem, options) {
		var slides = elem;
		slides.css('visibility', 'visible');
		var defaults = {
			vertical : false,
			speed : 3000,
			effect : '',
			captionTop : false,
			captionBottom : false,
			textbar : false,
		}
		var args = options;
		var args = $.extend({}, defaults, options);
		var rtl = $('body').css("direction");
		var nameit = slides.eq(0).attr('class');
		var slidesDivClass = '.' + nameit;
		var verticalSlide = args.vertical;
		var speed = args.speed;
		var AnimationEffect = args.effect;
		var captionTop = args.captionTop;
		var captionBottom = args.captionBottom;
		var EnableTextBar = args.textbar;
		var elwidth = args.elw;
		var elheight = args.elh;
		var cssSize = [];
		var slideShowInterval;
		var directional = -1;
		var PositionCounter = 1;
		var cssProperty = {};
		var animationDirection = null;
		var cssDimension = null;
		var slideDimension = null;
		var ourdiv = null;
		var numberOfSlides = 0;
		var swidth = $(window).width();
		var sheight = $(window).height();
		var slideWidth = 0;
		var slideHeight = 0;
		var wrapperSize = 0;
		var Innerwrapper = null;
		prepareWrapper();
		prepareSize();
		function prepareSize() {
			PositionCounter = 1;
			twidth = swidth * (elwidth / 100);
			theight = twidth * (elheight / 100); 
			slideWidth = Math.round(parseFloat(twidth));
			slideHeight = Math.round(parseFloat(theight));
			prepareDirection();
			prepareSlides();
			slideShowInterval = setInterval(changePosition, speed);
		}
		function prepareDirection() {
			if (verticalSlide === false) {
				if (rtl == "rtl") {
					animationDirection = 'marginRight';
					ourdiv.children().css({
						'float' : 'right'
					});
				} else {
					animationDirection = 'marginLeft';
					ourdiv.children().css({
						'float' : 'left'
					});
				}
				slideDimension = slideWidth;
				cssDimension = 'width';
			} else {
				animationDirection = 'marginTop';
				slideDimension = slideHeight;
				cssDimension = 'height';
			}
			return;
		}
		function prepareWrapper() {
			wrapper = 'wrapper_' + nameit;
			Innerwrapper = nameit + '_Innerwrapper';
			slides.wrapAll('<div id="' + wrapper + '"></div>');
			wrapperId = '#' + wrapper;
			ourdiv = $(wrapperId);
			var firstchild = ourdiv.children().first();
			var lastchild = ourdiv.children().last();
			var firstclone = firstchild.clone();
			var lastclone = lastchild.clone();
			firstclone.appendTo(ourdiv);
			lastclone.prependTo(ourdiv);
			numberOfSlides = ourdiv.children().length;
			ourdiv.wrapAll('<div id="' + Innerwrapper + '"></div>');
			return;
		}
		function prepareSlides() {
			ourdiv.find('img').css({
				'width' : slideWidth,
				'height' : slideHeight
			});
			ourdiv.find(slidesDivClass).css({
				'width' : slideWidth,
				'height' : slideHeight
			});
			ourdiv.parent().css({
				"width" : slideWidth,
				"height" : slideHeight,
				"overflow" : "hidden",
				"max-width" : "100%"
			});
			wrapperSize = slideDimension * numberOfSlides;
			ourdiv.css(cssDimension, wrapperSize);
			ourdiv.css(animationDirection, (directional) * (slideDimension) + 'px');
			if (captionTop) {
				ourdiv.children().eq(1).children('div.slidecaption').slideDown('slow', function () {
					if (captionBottom) {
						ourdiv.children().eq(1).children('div.slidetext').slideDown('slow');
					}
				});
			}
			cssSize[animationDirection] = (directional) * (slideDimension) + 'px';
			return;
		}
		ourdiv.hover(function () {
			clearInterval(slideShowInterval);
		}, function () {
			slideShowInterval = setInterval(changePosition, speed);
		});
		$(window).bind("debouncedresize", function () {
			clearInterval(slideShowInterval);
			ourdiv.stop(true, true);
			swidth = $(window).width();
			imgwidth = $("#" + Innerwrapper).parent().width();
			elwidth = (imgwidth / swidth) * 100;
			prepareSize();
		});
		function changePosition() {
			if (PositionCounter === (numberOfSlides - 1)) {
				ourdiv.css(animationDirection, (directional * slideDimension) + "px");
				PositionCounter = 0;
			}
			PositionCounter++;
			runSlider();
		}
		function runSlider() {
			cssProperty[animationDirection] = slideDimension * (directional * PositionCounter);
			ourdiv.animate(cssProperty, 1000, AnimationEffect, function () {
				if (captionTop) {
					ourdiv.children().children('div.slidecaption').hide();
					if (captionBottom) {
						ourdiv.children().children('div.slidetext').hide();
					}
					ourdiv.children().eq(PositionCounter).children('div.slidecaption').slideToggle('500', function () {
						if (captionBottom) {
							ourdiv.children().eq(PositionCounter).children('div.slidetext').slideToggle('1000');
						}
					});
				}
			});
		}
	};
	
	
	
	
	$.fn.loopItNow = function (options) {
		/* We need the Screen Width */
		var swidth = $(window).width();
		
		$(this).imagesLoaded(function () {
			
		/* The loaded image dimensions */
    		imgwidth = $(this).find('img').first().width();
			imgheight = $(this).find('img').first().height();
			
			/* The wrapper div dimensions */	 
			scrwidth = $(this).width();
			scrheight = $(this).height();
			
			/* the ratio of the image  */
		   if(imgheight < imgwidth)
			elheight = ((imgheight / imgwidth) * 100);
		   if(imgheight > imgwidth)
			elheight = ((imgwidth/imgheight) * 100);
			
			
			/* the ratio of the wrapper div to the screen */
			elwidth = (scrwidth / swidth) * 100;
		  
			options['elw'] = elwidth;
			options['elh'] = elheight;
			new LoopIt($(this), options);
		});
		return false;
	};
	
	
	
	var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';
	$.fn.imagesLoaded = function (callback) {
		var $this = this,
		deferred = $.isFunction($.Deferred) ? $.Deferred() : 0,
		hasNotify = $.isFunction(deferred.notify),
		$images = $this.find('img').add($this.filter('img')),
		loaded = [],
		proper = [],
		broken = [];
		if ($.isPlainObject(callback)) {
			$.each(callback, function (key, value) {
				if (key === 'callback') {
					callback = value;
				} else if (deferred) {
					deferred[key](value);
				}
			});
		}
		function doneLoading() {
			var $proper = $(proper),
			$broken = $(broken);
			if (deferred) {
				if (broken.length) {
					deferred.reject($images, $proper, $broken);
				} else {
					deferred.resolve($images);
				}
			}
			if ($.isFunction(callback)) {
				callback.call($this, $images, $proper, $broken);
			}
		}
		function imgLoaded(img, isBroken) {
			if (img.src === BLANK || $.inArray(img, loaded) !== -1) {
				return;
			}
			loaded.push(img);
			if (isBroken) {
				broken.push(img);
			} else {
				proper.push(img);
			}
			$.data(img, 'imagesLoaded', {
				isBroken : isBroken,
				src : img.src
			});
			if (hasNotify) {
				deferred.notifyWith($(img), [isBroken, $images, $(proper), $(broken)]);
			}
			if ($images.length === loaded.length) {
				setTimeout(doneLoading);
				$images.unbind('.imagesLoaded');
			}
		}
		if (!$images.length) {
			doneLoading();
		} else {
			$images.bind('load.imagesLoaded error.imagesLoaded', function (event) {
				imgLoaded(event.target, event.type === 'error');
			}).each(function (i, el) {
				var src = el.src;
				var cached = $.data(el, 'imagesLoaded');
				if (cached && cached.src === src) {
					imgLoaded(el, cached.isBroken);
					return;
				}
				if (el.complete && el.naturalWidth !== undefined) {
					imgLoaded(el, el.naturalWidth === 0 || el.naturalHeight === 0);
					return;
				}
				if (el.readyState || el.complete) {
					el.src = BLANK;
					el.src = src;
				}
			});
		}
		return deferred ? deferred.promise($this) : $this;
	};
})(jQuery);
(function ($) {
	var $event = $.event,
	$special,
	resizeTimeout;
	$special = $event.special.debouncedresize = {
		setup : function () {
			$(this).on("resize", $special.handler);
		},
		teardown : function () {
			$(this).off("resize", $special.handler);
		},
		handler : function (event, execAsap) {
			var context = this,
			args = arguments,
			dispatch = function () {
				event.type = "debouncedresize";
				$event.dispatch.apply(context, args);
			};
			if (resizeTimeout) {
				clearTimeout(resizeTimeout);
			}
			execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
		},
		threshold : 150
	};
})(jQuery);
