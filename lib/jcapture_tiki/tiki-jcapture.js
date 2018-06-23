// (c) Copyright 2002-2013 by authors of the Tiki Wiki CMS Groupware Project
// 
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
// $Id: tiki-jcapture.js 44444 2013-01-05 21:24:24Z changi67 $

// JS glue for jCapture feature

var jCaptureButton = null;

function openJCaptureDialog(area, page, event) {

	area = area == undefined ? "none" : area;
	page = page == undefined ? "test" : page;
	event = event == undefined ? {} : event;

	if (typeof event.target !== "undefined") {
		jCaptureButton = event.target;
	} else {		// for IE
		jCaptureButton = event.srcElement;
	}
	$(jCaptureButton).modal(" ");

	var $appletDiv = $("#jCaptureAppletDiv");
	if ($appletDiv.length) {
		$appletDiv.remove();
	}

	$appletDiv = $("<div id='jCaptureAppletDiv' style='width:1px;height:1px;visibility:hidden;position:absolute;left:-1000px;top:-1000px;'> </div>");
	$(document.body).append($appletDiv);

	$.get($.service('jcapture', 'capture'), {
			area: area,
			page: page
	}, function(data){
		$appletDiv.html(data);
		setTimeout(function () {$(jCaptureButton).modal();}, 5000);
	});

//	} else {	TODO later
//		$appletDiv[0].showCaptureFrame();
//	}

}

function insertAtCarret( areaId, dokuTag ) {

	if (jCaptureButton) {
		$(jCaptureButton).modal(" ");
	}

	$("#jCaptureAppletDiv").hide();

	var name = dokuTag.substring(3, dokuTag.length - 3);

	$.getJSON($.service('file', 'find'), {
			name: name,
			galleryId: jqueryTiki.jcaptureFgal
	}, function(data) {

		if (jCaptureButton) {
			$(jCaptureButton).modal();
			jCaptureButton = null;
		}

		if (data) {
			if (!areaId || areaId == "none") {
				if (confirm("Capture file " + name + " (fileId: " + data.fileId + ") uploaded, do you want to view the file in the gallery?")) {
					location.assign("tiki-list_file_gallery.php?galleryId=" + data.galleryId);
				}
			} else {
				var tag;
				if (data.filetype.indexOf("image") === 0) {
					tag = "{img fileId=\"" + data.fileId + "\"}";
				} else if (data.filetype.indexOf("shockwave-flash") > -1) {
					var size = "", m = name.match(/(.*?)\??(\d+)x(\d+)/);
					if (m.length) {
						size = " width=\"" + m[2] + "\" height=\"" + m[3] + "\"";
					}
					if (jqueryTiki.sefurl) {
						tag = "{flash type=\"url\" movie=\"display" + data.fileId + "\"" + size + "}";
					} else {
						tag = "{flash type=\"url\" movie=\"tiki-download_file.php?fileId=" + data.fileId + "&display\"" + size + "}";
					}
				}
				insertAt( areaId, tag);
			}
		} else {
			alert("Missing file info for file: " + name);
		}

		$("#jCaptureAppletDiv").remove();
	});

}