/* JQS5 - JQS5 - jQuery Simple Standards-Based Slide Show System
 * 
 * Copyright 2008 Steve Pomeroy <steve@staticfree.info>
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.

   Conceptually based on S5, with a little code borrowed from it.
 */

/* initialize the jQuery.s5 rendering */
jQuery.fn.extend({
	s5: function (settings){
		settings = jQuery.s5.s = jQuery.extend({
			menu: function() { //navigational menu for presenter
				return jQuery(
					'<a href="#" onclick="jQuery.s5.go(\'first\'); return false;" title="First"><img src="images/resultset_first.png" alt="First" /></a> ' + 
					'<a href="#" onclick="jQuery.s5.go(\'prev\'); return false;" title="Prev"><img src="images/resultset_previous.png" alt="Prev" /></a> ' + 
					'<a href="#" onclick="jQuery.s5.go(\'next\'); return false;" title="Next"><img src="images/resultset_next.png" alt="Next" /></a> ' + 
					'<a href="#" onclick="jQuery.s5.go(\'last\'); return false;" title="Last"><img src="images/resultset_last.png" alt="Last" /></a> ' +
					'<a href="#" onclick="jQuery.s5.toggleRegularView(); return false;" title="Toggle Regular View"><img src="images/application_view_list.png " alt="Toggle Regular View" /></a> ' +
					'<a href="#" onclick="jQuery.s5.listSlideTitles(); return false;" title="Jump To Slide" class="listSlideTitlesAnchor"><img src="images/layers.png" alt="Jump To Slide" /></a> ' +
					'<a href="#" onclick="jQuery.s5.autoPlay(true); return false;" title="Play"><img src="images/control_play_blue.png" alt="Play" /></a> ' +
					'<a href="#" onclick="jQuery.s5.s.pause = true; return false;" title="Pause"><img src="images/control_pause_blue.png" alt="Pause" /></a> ' +
					'<a href="#" onclick="jQuery.s5.s.pause = true; go(\'first\'); return false;" title="Stop"><img src="images/control_stop_blue.png" alt="Stop" /></a> ' +
					'<a href="#" onclick="jQuery.s5.getNote(); return false;" title="Notes"><img src="images/note.png" alt="Notes" /></a> ' +
					'<a href="#" onclick="jQuery.s5.toggleLoop(); return false;" title="Toggle Loop"><img src="images/arrow_rotate_clockwise.png" alt="Toggle Loop" /></a>'
				);
			},
			slideNum: jQuery('<span id="slideNum"></span>'),
			noteTemplate: function() { //here we will help the presenter by giving him/her more info so they know what to present
				return jQuery('<div />');
			},
			parent: jQuery(this),
			slideDuration: 10000,
			paused: false,
			play: false,
			loop: false,
			imageSizeAdjustment: function(s) {
				return s / 2;
			},
			imageSizeToAdjust: {height: 100, width: 100}
		}, settings);
		
		/* private functions */
		var fn = {
			keys: function (key) {
				if (!key) {
					key = event;
					key.which = key.keyCode;
				}
				switch (key.which) {
					case 10: // return
					case 13: // enter
					case 32: // spacebar
					case 34: // page down
					case 39: // rightkey
					case 40: // downkey
						jQuery.s5.go('next');
						break;
					case 33: // page up
					case 37: // leftkey
					case 38: // upkey
					case  8: // backspace
						jQuery.s5.go('prev');
						break;
					case 36: // home
						jQuery.s5.go(0);
						break;
					case 35: // end
						jQuery.s5.go(this.slideCount - 1);
						break;
					case 67: // c
						break;
					case 79: // o
						jQuery.s5.listSlideTitles();
				}
				return false;
			},
			// Key trap fix, new function body for trap()
			trap: function (e) {
				if (!e) {
					e = event;
					e.which = e.keyCode;
				}
				try {
					modifierKey = e.ctrlKey || e.altKey || e.metaKey;
				}
				catch(e) {
					modifierKey = false;
				}
				return modifierKey || e.which == 0;
			},
			clicker: function (e) {
				var target;
				if (window.event) {
					target = window.event.srcElement;
					e = window.event;
				} else target = e.target;
				if (target.getAttribute('href') != null) return true;
				if (!e.which || e.which == 1) {
					jQuery.s5.go('next');
				}
			}
		};
		
		var body = jQuery.s5.body = jQuery('body');
		jQuery.s5.makeSizeDetector();
		
		jQuery.s5.originalView = body.children().clone()
			.hide()
			.prepend('<div class="toggleRegularView"><a href="#" onclick="jQuery.s5.toggleRegularView(); return false;">BACK TO SLIDES</a></div>');
		
		/* prep notes */
		jQuery('.note').hide();
		jQuery(window).unload(function() {
			if (jQuery.s5.note) {
				jQuery.s5.note.close();
			}
		});
		
		/* inject some elements to stylize each slide */
		var footer = jQuery('<div class="footer" />').appendTo(body);

		// create an outline container
		var outline = jQuery('<div class="outline" />').appendTo(body);
		var outlineList = jQuery('<ul />').appendTo(outline);
		
		jQuery('h1, h2').each(function(i){ 
			var a = jQuery("<a>" + jQuery(this).text() + "</a>")
				.attr('href', '#s' + i)
				.click(function(e){
					jQuery.s5.go(i);
					return false;
				})
				.prependTo(
					jQuery("<li/>").appendTo(outlineList)
				);
		});
		
		outline.prepend('<div onclick="jQuery.s5.listSlideTitles(); return false;" class="outlookClose" href="#">close</div>');
		
		// siblingsUntil is a custom selector that is added to jQuery by this library
		jQuery(this).children('h1').each(function(){
			jQuery(this)
				.add(jQuery(this).siblingsUntil('h2'))
				.wrapAll('<div class="slide" />');
				
			jQuery(this).parent().addClass('first');
		});
		
		jQuery(this).children('h2').each(function(){
			jQuery(this)
				.add(jQuery(this).siblingsUntil('h2'))
				.wrapAll('<div class="slide" />');
		});

		// initialize 
		var slides = jQuery.s5.slides().hide();
		jQuery.s5.slideCount = slides.length;
		
		footer.html(slides.eq(0).clone().removeClass('slide first').show());
		jQuery.s5.scale();

		// load the key/mouse bindings
		jQuery(document)
			.keyup(fn.keys)
			.keypress(fn.trap);

		jQuery(window).resize(function() {
			jQuery.s5.scale();
		});
		
		var menu = jQuery.s5.menu = jQuery('<div class="s5Menu" />')
			.append(settings.menu())
			.appendTo(body)
			.fadeTo(0, .01)
			.hover(function() {
				menu.stop().fadeTo(200, .9);
			}, function() {
				menu.stop().fadeTo(200, .01);
			});
		
		body
			.children()
			.not(menu)
			.click(fn.clicker);
			
		var first_slide = Number(document.location.hash.substring(2));
		// start the presentation
		jQuery.s5.go(first_slide);


		
		
		body.find('.footer').prepend('<span id="slideNum" />');
		jQuery.s5.updateSlideNumber();
		
		jQuery.s5.timeManager('init');
		
		return settings.parent;
	},
	// selects a node's sibling's until the sibling matches
	siblingsUntil: function( match ){
		var r = [];
		jQuery(this).each(function(i){
			for(var n = this.nextSibling; n; n = n.nextSibling){
				if(jQuery(n).is(match)){
					break;
				}
				r.push(n);
			}
		});
		return this.pushStack( jQuery.unique( r ) );
	}
});

jQuery.extend({
	s5: {
		i: -1, //current integer of the active slide
		slideCount: -1, //total number of slides
		slides: function() { return jQuery('.slide'); },
		menu: {},
		getNote: function() { //displays notes for the presenter
			if (!this.note) {
				this.note = window.open('', 'jQuery_s5_note', 'top=0,left=0');
				this.note.document.write(
					'<html>' + 
						'<head>' + 
							'<title>Notes</title>' +
						'</head>' +
						'<body>' +
							'<table style="width: 100%;">' +
								'<tr>' +
									'<td>Time Elapsed</td>' +
									'<td>Time Remaining Overall</td>' +
									'<td>Time Remaining on Slide</td>' +
								'</tr>' +
								'<tr>' +
									'<td id="noteTimeElapsed">0:0:0</td>' +
									'<td id="noteTimeOveralRemaining">0:0:0</td>' +
									'<td id="noteTimeSlideRemaining">0:0:0</td>' +
								'</tr>' +
							'</table>' +
							
							'<div id="activeNote">' + this.slides().eq(this.i).find('.note').html() + '</div>' + 
						'</body>' + 
					'</html>'
				);
			} else {
				this.note.close();
				this.note = '';
			}
		},
		autoPlay: function(start) {	//Plays the slide show, changing at intervals based on the setting slideDuration
			if (start) {
				this.s.play = true;
				this.s.pause = false;
			}
			
			if (!this.s.pause && this.s.play) {			
				this.timeManager();
			}
			
			if (!this.time.run) {
				this.time.run = setTimeout('jQuery.s5.autoPlay();', 1000);
			}
		},
		time: {
			elapsed: -1,
			slideRemaining: -1,
			overalRemaining: -1
		},
		timeManager: function(type) {
			if (!this.s.stop && this.s.play && !this.s.paused) {
				var rmn = function() {
					return (jQuery.s5.slideCount * jQuery.s5.s.slideDuration) - (jQuery.s5.i * jQuery.s5.s.slideDuration);
				};
				switch (type ? type : '') {
					case 'init':
						this.time.elapsed = 0;
						this.time.slideRemaining = this.s.slideDuration;
						this.time.overalRemaining = rmn();
						break;
					case 'reset':
						
					default:
						this.time.slideRemaining -= 1000;
						if (this.time.overalRemaining > 0) {
							this.time.overalRemaining -= 1000;
						}
				}
				
				if (this.time.slideRemaining <= 0) {
					if (this.s.loop && this.i == this.slideCount - 1) {
						this.go('first');
					} else {
						this.go('next');
					}
					
					this.time.slideRemaining = this.s.slideDuration;
					this.time.overalRemaining = rmn();
				}
				
				this.time.elapsed += 1000;
				
				this.noteDomSetHtml("noteTimeElapsed", this.formatTime(this.time.elapsed / 1000));
				this.noteDomSetHtml("noteTimeOveralRemaining", this.formatTime(this.time.overalRemaining / 1000));
				this.noteDomSetHtml("noteTimeSlideRemaining", this.formatTime(this.time.slideRemaining / 1000));
			}
		},
		formatTime: function(secs, format) {
			format = (format ? format : function(o) {
				return o.h + ':' + o.m + ':' + o.s;
			});
		    var hours = Math.floor(secs / (60 * 60));
		    var divisor_for_minutes = secs % (60 * 60);
		    var minutes = Math.floor(divisor_for_minutes / 60);
		    var divisor_for_seconds = divisor_for_minutes % 60;
		    var seconds = Math.ceil(divisor_for_seconds);
		    
		    return format({
		        h: hours,
		        m: minutes,
		        s: seconds
		    });
		},
		listSlideTitles: function() { //Lists slide titles so that user can click and change the active slide
			var offset = jQuery('a.listSlideTitlesAnchor').offset();
			jQuery('.outline')
				.toggle('fast')
				.css('left', offset.left + 'px')
				.css('bottom', '0px');
		},
		toggleRegularView: function() { //Changes the view of slide to that of an html page, with the option to go back to slide view
			if (!this.slideView) {
				this.slideView = this.body.children();
				this.originalView.appendTo(this.body);
			}
			
			if (!this.slideView.off) {
				this.slideView.off = true;
				this.slideView.hide();
				this.originalView.show();
				
				this.menu
					.css('left', '-10000px');
			} else {
				this.slideView.off = false;
				this.slideView.show();
				this.originalView.hide();
				
				this.menu
					.css('left', '0px');
			}
			jQuery('.outline').hide();
		},
		updateSlideNumber: function() { //Displays the slide count on the slide show in the 
			if (this.i) {
				jQuery('#slideNum').html('Slide: ' + this.i + '/' + (this.slideCount - 1));
			} else {
				jQuery('#slideNum').html('');
			}
		},
		toggleLoop: function() { //Toggles looping in the slideshow playback
			if (jQuery.s5.s.loop) {
				jQuery.s5.s.loop = false;
			} else {
				jQuery.s5.s.loop = true;
			}
		},
		go: function(n){ //Navigates to a specific slide
			if(typeof n == 'string'){
				switch(n) {
				case 'next': n = (this.i < (this.slideCount-1) ? this.i + 1 : this.i);
					break;
				case 'prev': n = ( this.i > 0 ? this.i - 1 : this.i );
					break;
				case 'last': n = this.slideCount - 1;
					break;		
				case 'first': n = 0;
					break;
				}
			}
			if(n == this.i) return;
			this.prev = this.i;
			this.i = n;
			
			var slides = this.slides();
			
			slides.eq(this.prev).css('z-index', 0).fadeOut();
			slides.eq(this.i).css('z-index', 100).fadeIn();
			
			if(this.i == 0){
				jQuery('.footer').slideUp();
				this.timeManager('reset');
			} else {
				jQuery('.footer').slideDown();
			}
			
			this.noteDomSetHtml('activeNote', slides.eq(this.i).find('.note').html());
			
			jQuery('.outline').find('li')
				.removeClass('active')
				.eq(this.i)
					.addClass('active');
			
			document.location.hash = "#s" + n;
			
			this.updateSlideNumber();
		},
		noteDomSetHtml: function(id, html) {
			if (this.note) {
				jQuery(this.note.document).find('#' + id).html(html ? html : 'No notes for this slide.');
			}
		},
		scale: function () {  // causes layout problems in FireFox that get fixed if browser's Reload is used; same may be true of other Gecko-based browsers
			var vScale = 22;  // both yield 32 (after rounding) at 1024x768
			var hScale = 32;  // perhaps should auto-calculate based on theme's declared value?
			var $window = jQuery(window);
			var vSize = $window.height();
			var hSize = $window.width();
			
			var newSize = Math.min(Math.round(vSize / vScale), Math.round(hSize / hScale));
			//resize fonts
			this.body.css('font-size', newSize + 'px');
			
			//resize images
			this.slides().find('img').each(function() {
				var w = jQuery(this).width();
				var h = jQuery(this).height();
				
				if (
					h > jQuery.s5.s.imageSizeToAdjust.height ||
					w > jQuery.s5.s.imageSizeToAdjust.width
				) {
					jQuery(this).width(jQuery.s5.s.imageSizeAdjustment(jQuery('#s5SizeDetector').height()) * newSize);
				}
			});
		},
		makeSizeDetector: function() {
			jQuery('<div id="s5SizeDetector" />').appendTo(this.body);
		}
	}
});
