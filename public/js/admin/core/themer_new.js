/*
 * MWS Admin v2.1 - Themer JS
 * This file is part of MWS Admin, an Admin template build for sale at ThemeForest.
 * All copyright to this file is hold by Mairel Theafila <maimairel@yahoo.com> a.k.a nagaemas on ThemeForest.
 * Last Updated:
 * December 08, 2012
 *
 */
	var ColorPicker = function(defaultId,defaultImgId,defaultBase,defaultHighlight,defaultText,defaultTextGlow,imgRoot) {
		var backgroundPattern = imgRoot+"core/bg/paper.png";
		var baseColor = "#35353a";
		var highlightColor = "#c5d52b";
		var textColor = "#c5d52b";
		var textGlowColor = {r: 197, g: 213, b: 42, a: 0.5};
		
		var patterns = [
			{
				name: "Paper", 
				img: imgRoot+"core/bg/paper.png"
			}, {
				name: "Blueprint", 
				img: imgRoot+"core/bg/blueprint.png"
			}, {
				name: "Bricks", 
				img: imgRoot+"core/bg/bricks.png"
			}, {
				name: "Carbon", 
				img: imgRoot+"core/bg/carbon.png"
			}, {
				name: "Circuit", 
				img: imgRoot+"core/bg/circuit.png"
			}, {
				name: "Holes", 
				img: imgRoot+"core/bg/holes.png"
			}, {
				name: "Mozaic", 
				img: imgRoot+"core/bg/mozaic.png"
			}, {
				name: "Roof", 
				img: imgRoot+"core/bg/roof.png"
			}, {
				name: "Stripes", 
				img: imgRoot+"core/bg/stripes.png"
			}, {
				name: "Arches", 
				img: imgRoot+"core/bg/arches.png"
			}, {
				name: "Bright Squares", 
				img: imgRoot+"core/bg/bright_squares.png"
			}, {
				name: "Brushed Alu", 
				img: imgRoot+"core/bg/brushed_alu.png"
			}, {
				name: "Circles", 
				img: imgRoot+"core/bg/circles.png"
			}, {
				name: "Climpek", 
				img: imgRoot+"core/bg/climpek.png"
			}, {
				name: "Connect", 
				img: imgRoot+"core/bg/connect.png"
			}, {
				name: "Corrugation", 
				img: imgRoot+"core/bg/corrugation.png"
			}, {
				name: "Cubes", 
				img: imgRoot+"core/bg/cubes.png"
			}, {
				name: "Diagonal Noise", 
				img: imgRoot+"core/bg/diagonal-noise.png"
			}, {
				name: "Diagonal Striped Brick", 
				img: imgRoot+"core/bg/diagonal_striped_brick.png"
			}, {
				name: "Diamonds", 
				img: imgRoot+"core/bg/diamonds.png"
			}, {
				name: "Diamond Upholstery", 
				img: imgRoot+"core/bg/diamond_upholstery.png"
			}, {
				name: "Escheresque", 
				img: imgRoot+"core/bg/escheresque.png"
			}, {
				name: "Fabric Plaid", 
				img: imgRoot+"core/bg/fabric_plaid.png"
			}, {
				name: "Furley", 
				img: imgRoot+"core/bg/furley_bg.png"
			}, {
				name: "Gplaypattern", 
				img: imgRoot+"core/bg/gplaypattern.png"
			}, {
				name: "Gradient Squares", 
				img: imgRoot+"core/bg/gradient_squares.png"
			}, {
				name: "Grey", 
				img: imgRoot+"core/bg/grey.png"
			}, {
				name: "Grilled", 
				img: imgRoot+"core/bg/grilled.png"
			}, {
				name: "Hexellence", 
				img: imgRoot+"core/bg/hexellence.png"
			}, {
				name: "Lghtmesh", 
				img: imgRoot+"core/bg/lghtmesh.png"
			}, {
				name: "Light Alu", 
				img: imgRoot+"core/bg/light_alu.png"
			}, {
				name: "Light Checkered Tiles", 
				img: imgRoot+"core/bg/light_checkered_tiles.png"
			}, {
				name: "Light Honeycomb", 
				img: imgRoot+"core/bg/light_honeycomb.png"
			}, {
				name: "Littleknobs", 
				img: imgRoot+"core/bg/littleknobs.png"
			}, {
				name: "Nistri", 
				img: imgRoot+"core/bg/nistri.png"
			}, {
				name: "Noise Lines", 
				img: imgRoot+"core/bg/noise_lines.png"
			}, {
				name: "Noise Pattern", 
				img: imgRoot+"core/bg/noise_pattern_with_crosslines.png"
			}, {
				name: "Noisy Grid", 
				img: imgRoot+"core/bg/noisy_grid.png"
			}, {
				name: "Norwegian Rose", 
				img: imgRoot+"core/bg/norwegian_rose.png"
			}, {
				name: "Pineapplecut", 
				img: imgRoot+"core/bg/pineapplecut.png"
			}, {
				name: "Pinstripe", 
				img: imgRoot+"core/bg/pinstripe.png"
			}, {
				name: "Project Papper", 
				img: imgRoot+"core/bg/project_papper.png"
			}, {
				name: "Ravenna", 
				img: imgRoot+"core/bg/ravenna.png"
			}, {
				name: "Reticular Tissue", 
				img: imgRoot+"core/bg/reticular_tissue.png"
			}, {
				name: "Rockywall", 
				img: imgRoot+"core/bg/rockywall.png"
			}, {
				name: "Roughcloth", 
				img: imgRoot+"core/bg/roughcloth.png"
			}, {
				name: "Shattered", 
				img: imgRoot+"core/bg/shattered.png"
			}, {
				name: "Silver Scales", 
				img: imgRoot+"core/bg/silver_scales.png"
			}, {
				name: "Skelatal Weave", 
				img: imgRoot+"core/bg/skelatal_weave.png"
			}, {
				name: "Small Crackle Bright", 
				img: imgRoot+"core/bg/small-crackle-bright.png"
			}, {
				name: "Small Tiles", 
				img: imgRoot+"core/bg/small_tiles.png"
			}, {
				name: "Square", 
				img: imgRoot+"core/bg/square_bg.png"
			}, {
				name: "Struckaxiom", 
				img: imgRoot+"core/bg/struckaxiom.png"
			}, {
				name: "Subtle Stripes", 
				img: imgRoot+"core/bg/subtle_stripes.png"
			}, {
				name: "Vichy", 
				img: imgRoot+"core/bg/vichy.png"
			}, {
				name: "Washi", 
				img: imgRoot+"core/bg/washi.png"
			}, {
				name: "Wavecut", 
				img: imgRoot+"core/bg/wavecut.png"
			}, {
				name: "Weave", 
				img: imgRoot+"core/bg/weave.png"
			}, {
				name: "Whitey", 
				img: imgRoot+"core/bg/whitey.png"
			}, {
				name: "White Brick Wall", 
				img: imgRoot+"core/bg/white_brick_wall.png"
			}, {
				name: "White Tiles", 
				img: imgRoot+"core/bg/white_tiles.png"
			}, {
				name: "Worn Dots", 
				img: imgRoot+"core/bg/worn_dots.png"
			}
		];
		
		var presets = [
			{
				name: "Default", 
				baseColor: "35353a", 
				highlightColor: "c5d52b", 
				textColor: "c5d52b", 
				textGlowColor: {r: 197, g: 213, b: 42, a: 0.6}
			}, {
				name: "Army", 
				baseColor: "363d1b", 
				highlightColor: "947131", 
				textColor: "ffb575", 
				textGlowColor: {r: 237, g: 255, b: 41, a: 0.6}
			}, {
				name: "Rocky Mountains", 
				baseColor: "2f2f33", 
				highlightColor: "808080", 
				textColor: "b0e6ff", 
				textGlowColor: {r: 230, g: 232, b: 208, a: 0.6}
			}, {
				name: "Chinese Temple", 
				baseColor: "4f1b1b", 
				highlightColor: "e8cb10", 
				textColor: "f7ff00", 
				textGlowColor: {r: 255, g: 255, b: 0, a: 0.6}
			}, {
				name: "Boutique", 
				baseColor: "292828", 
				highlightColor: "f08dcc", 
				textColor: "fcaee3", 
				textGlowColor: {r: 186, g: 9, b: 230, a: 0.6}
			}, {
				name: "Toxic", 
				baseColor: "42184a", 
				highlightColor: "97c730", 
				textColor: "b1ff4c", 
				textGlowColor: {r: 230, g: 232, b: 208, a: 0.6}
			}, {
				name: "Aquamarine", 
				baseColor: "192a54", 
				highlightColor: "88a9eb", 
				textColor: "8affe2", 
				textGlowColor: {r: 157, g: 224, b: 245, a: 0.6}
			}
		];
		
		var backgroundTargets = 
		[
			"body", 
			"#mws-container"
		];
		
		var baseColorTargets = 
		[
			"#mws-sidebar", 
			"#mws-sidebar-bg", 
			"#mws-header", 
			".mws-panel .mws-panel-header", 
			"#mws-login", 
			"#mws-login .mws-login-lock", 
			".ui-accordion .ui-accordion-header", 
			".ui-tabs .ui-tabs-nav", 
			".ui-datepicker", 
			".fc-event-skin", 
			".ui-dialog .ui-dialog-titlebar", 
			".jGrowl .jGrowl-notification, .jGrowl .jGrowl-closer", 
			"#mws-user-tools .mws-dropdown-menu .mws-dropdown-box", 
			"#mws-user-tools .mws-dropdown-menu.open .mws-dropdown-trigger"
		];
		
		var borderColorTargets = 
		[
			"#mws-header"
		];
		
		var highlightColorTargets = 
		[
			"#mws-searchbox .mws-search-submit", 
			".mws-panel .mws-panel-header .mws-collapse-button span", 
			".dataTables_wrapper .dataTables_paginate .paginate_disabled_previous", 
			".dataTables_wrapper .dataTables_paginate .paginate_enabled_previous", 
			".dataTables_wrapper .dataTables_paginate .paginate_disabled_next", 
			".dataTables_wrapper .dataTables_paginate .paginate_enabled_next", 
			".dataTables_wrapper .dataTables_paginate .paginate_active", 
			".mws-table tbody tr.odd:hover td", 
			".mws-table tbody tr.even:hover td", 
			".ui-slider-horizontal .ui-slider-range", 
			".ui-slider-vertical .ui-slider-range", 
			".ui-progressbar .ui-progressbar-value", 
			".ui-datepicker td.ui-datepicker-current-day", 
			".ui-datepicker .ui-datepicker-prev", 
			".ui-datepicker .ui-datepicker-next", 
			".ui-accordion-header .ui-accordion-header-icon", 
			".ui-dialog-titlebar-close"
		];
		
		var textTargets = 
		[
			".mws-panel .mws-panel-header span", 
			"#mws-navigation ul li.active a", 
			"#mws-navigation ul li.active span", 
			"#mws-user-tools #mws-username", 
			"#mws-navigation ul li .mws-nav-tooltip", 
			"#mws-user-tools #mws-user-info #mws-user-functions #mws-username", 
			".ui-dialog .ui-dialog-title", 
			".ui-state-default", 
			".ui-state-active", 
			".ui-state-hover", 
			".ui-state-focus", 
			".ui-state-default a", 
			".ui-state-active a", 
			".ui-state-hover a", 
			".ui-state-focus a"
		];
		
		$("#mws-themer-getcss").on("click.themer", function(e) {
			$("#mws-themer-css-dialog textarea").val(generateCSS("../"));
			$("#mws-themer-css-dialog").dialog("open");
			e.preventDefault();
		});
		
		$(".get_css").on("click.themer", function(e) {
			$(".get_css_div").val(generateCSS());
		});
		
		var presetDd = $('<select id="mws-theme-presets" name="data[School][color_presets_id]" class="small"></select>');
		$.each(presets, function( i, p ) {
			var option = $("<option></option>").text(p.name).val(i);
			presetDd.append(option);
			
		});
		$("#mws-theme-presets-container").append(presetDd);
		presetDd.on('change.themer', function(e) {
			$('#color_presets').val(presets[presetDd.val()].name);
			updateBaseColor(presets[presetDd.val()].baseColor);
			updateHighlightColor(presets[presetDd.val()].highlightColor);
			updateTextColor(presets[presetDd.val()].textColor);
			updateTextGlowColor(presets[presetDd.val()].textGlowColor, presets[presetDd.val()].textGlowColor.a);
			attachStylesheet();
			e.preventDefault();
		});
		
		// load default value when user submit form or on edit form
		updateBaseColor(defaultBase);
		updateHighlightColor(defaultHighlight);
		updateTextColor(defaultText);
		updateTextGlowColor({r: hexToRgb(defaultTextGlow).r, g: hexToRgb(defaultTextGlow).g, b: hexToRgb(defaultTextGlow).b}, '0.6');
		
		var patternDd = $('<select id="mws-theme-patterns" name="data[School][background_theme_id]" class="small"></select>');
		$.each(patterns, function( i, p ) {
			var option = $("<option></option>").text(p.name).val(i);
			patternDd.append(option);
		});
		$("#mws-theme-pattern-container").append(patternDd);
		
		patternDd.on('change', function(e) {
			updateBackground(patterns[patternDd.val()].img, true);
			$("#background_theme").val(patterns[patternDd.val()].img);
			e.preventDefault();
		});
		
		// load default value when user submit form or on edit form
		updateBackground(patterns[defaultImgId].img, true);
		
		$("#mws-themer-toggle").on("click", function(e) {
			var toggle = $(this);
			if($(this).hasClass("opened")) {
				toggle.parent().stop().animate({right: "0"}, "slow", function() {
					toggle.removeClass('opened');
				});
			} else {
				toggle.parent().stop().animate({right: "256"}, "slow", function() {
					toggle.addClass('opened');
				});
			}
		});
		
		$("#mws-textglow-op").slider({
			range: "min", 
			min:0, 
			max: 100, 
			value: 50, 
			slide: function(event, ui) {
				alpha = ui.value * 1.0 / 100.0;
				updateTextGlowColor(null, alpha);
			}
		});
		
		$("#mws-themer-css-dialog").dialog({
			autoOpen: false, 
			title: "Theme CSS", 
			width: 500, 
			modal: true, 
			resize: false, 
			buttons: {
				"Close": function() { $(this).dialog("close"); }
			}
		});
		
		$("#mws-base-cp").ColorPicker({
			color: baseColor, 
			onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
			},
			onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
			},
			onChange: function (hsb, hex, rgb) {			
				updateBaseColor(hex, true);
			}
		});
		
		$("#mws-highlight-cp").ColorPicker({
			color: highlightColor, 
			onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
			},
			onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
			},
			onChange: function (hsb, hex, rgb) {			
				updateHighlightColor(hex, true);
			}
		});
		
		$("#mws-text-cp").ColorPicker({
			color: textColor, 
			onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
			},
			onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
			},
			onChange: function (hsb, hex, rgb) {			
				updateTextColor(hex, true);
			}
		});
		
		$("#mws-textglow-cp").ColorPicker({
			color: textGlowColor, 
			onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
			},
			onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
			},
			onChange: function (hsb, hex, rgb) {
				updateTextGlowColor(rgb, textGlowColor["a"], true);
			}
		});
		function updateBackground(bg, attach)
		{
			backgroundPattern = bg;
			
			if(attach == true)
				attachStylesheet();
		}
		
		function updateBaseColor(hex, attach)
		{
			baseColor = "#" + hex;
			
			$("#mws-base-cp").css('backgroundColor', baseColor);
			$("#mws-footer-fix").css('backgroundColor', baseColor);
			
			$("#base_theme").val(baseColor);
			if(attach === true)
				attachStylesheet();
		}
		
		function updateHighlightColor(hex, attach)
		{
			highlightColor = "#" + hex;
			$("#mws-highlight-cp").css('backgroundColor', highlightColor);
			$("#highlight_theme").val(highlightColor);
			
			if(attach === true)
				attachStylesheet();
		}
		
		function updateTextColor(hex, attach)
		{
			textColor = "#" + hex;
			$("#mws-text-cp").css('backgroundColor', textColor);
			$('#text_color_theme').val(textColor);
			if(attach === true)
				attachStylesheet();
		}		
		function updateTextGlowColor(rgb, alpha, attach)
		{
			if(rgb != null) {
				textGlowColor.r = rgb["r"];
				textGlowColor.g = rgb["g"];
				textGlowColor.b = rgb["b"];
				textGlowColor.a = alpha;
			} else {
				textGlowColor.a = alpha;
			}
			
			$("#mws-textglow-op").slider("value", textGlowColor.a * 100);
			$("#mws-textglow-cp").css('backgroundColor', '#' + rgbToHex(textGlowColor.r, textGlowColor.g, textGlowColor.b));
			$("#text_glow_color_theme").val('#' + rgbToHex(textGlowColor.r, textGlowColor.g, textGlowColor.b));
			if(attach === true)
				attachStylesheet();
		}
		function attachStylesheet(basePath)
		{
			if($("#mws-stylesheet-holder").size() == 0) {
				$('body').append('<div id="mws-stylesheet-holder"></div>');
			}
			$("#mws-stylesheet-holder").html($('<style type="text/css">' + generateCSS(basePath) + '</style>'));
		}
		
		function generateCSS(basePath)
		{
			if(!basePath)
				basePath = "";
				
			var css = 
				backgroundTargets.join(", \n") + "\n" + 
				"{\n"+
				"	background-image:url('" + basePath + backgroundPattern + "');\n"+
				"}\n\n"+			
				baseColorTargets.join(", \n") + "\n" + 
				"{\n"+
				"	background-color:" + baseColor + ";\n"+
				"}\n\n"+
				borderColorTargets.join(", \n") + "\n" + 
				"{\n"+
				"	border-color:" + highlightColor + ";\n"+
				"}\n\n"+
				textTargets.join(", \n") + "\n" + 
				"{\n"+
				"	color:" + textColor + ";\n"+
				"	text-shadow:0 0 6px rgba(" + getTextGlowArray().join(", ") + ");\n"+
				"}\n\n"+
				highlightColorTargets.join(", \n") + "\n" + 
				"{\n"+
				"	background-color:" + highlightColor + ";\n"+
				"}\n";
				
			return css;
		}
		
		function getTextGlowArray()
		{
			var array = new Array();
			for(var i in textGlowColor)
				array.push(textGlowColor[i]);
				
			return array;
		}
		
		function rgbToHex(r, g, b)
		{
			var rgb = b | (g << 8) | (r << 16);
			return rgb.toString(16);
		}
		function hexToRgb(hex) {
			var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
			return result ? {
				r: parseInt(result[1], 16),
				g: parseInt(result[2], 16),
				b: parseInt(result[3], 16)
			} : null;
		}
	};