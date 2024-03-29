// If XMLHttpRequest is not defined, we need to create it
if (typeof XMLHttpRequest == 'undefined') {
	XMLHttpRequest = function () {
		try { return new ActiveXObject("Msxml2.XMLHTTP.6.0"); }
		catch (e1) {}
		try { return new ActiveXObject("Msxml2.XMLHTTP.3.0"); }
		catch (e2) {}
		try { return new ActiveXObject("Msxml2.XMLHTTP"); }
		catch (e3) {}
		//Microsoft.XMLHTTP points to Msxml2.XMLHTTP.3.0 and is redundant
		throw new Error("This browser does not support XMLHttpRequest.");
	};
}

// Plugin Detection Functionality
var slimstat_plugins = {
	acrobat: { substrs: [ "Adobe", "Acrobat" ], progIds: [ "AcroPDF.PDF", "PDF.PDFCtrl.5" ] },
	director: { substrs: [ "Shockwave", "Director" ], progIds: [ "SWCtl.SWCtl" ] },
	flash: { substrs: [ "Shockwave", "Flash" ], progIds: [ "ShockwaveFlash.ShockwaveFlash" ] },	
	java: { substrs: [ "Java" ], progIds: [ "JavaWebStart.isInstalled" ] },
	mediaplayer: { substrs: [ "Windows Media" ], progIds: [ "WMPlayer.OCX" ] },
	quicktime: { substrs: [ "QuickTime" ], progIds: [ "QuickTime.QuickTime" ] },	
	real: { substrs: [ "RealPlayer" ], progIds: [ "rmocx.RealPlayer G2 Control", "RealPlayer.RealPlayer(tm) ActiveX Control (32-bit)", "RealVideo.RealVideo(tm) ActiveX Control (32-bit)" ] },	
	silverlight: { substrs: [ "Silverlight" ], progIds: [ "AgControl.AgControl" ] }
};
function slimstat_detect_plugin(substrs) {
	if (navigator.plugins) {
		for (var i = 0; i < navigator.plugins.length; i++) {
			var plugin = navigator.plugins[i];
			var haystack = plugin.name + plugin.description;
			var found = 0;

			for (var j = 0; j < substrs.length; j++) {
				if (haystack.indexOf(substrs[j]) != -1) {
					found++;
				}
			}
	
			if (found == substrs.length) {
				return true;
			}
		}
	}
	return false;
}

// VBScript block for Internet Explorer
var detectableWithVB = false;
if ((navigator.userAgent.indexOf('MSIE') != -1) && (navigator.userAgent.indexOf('Win') != -1)) {
    document.writeln('<scr' + 'ipt language="VBscript">');
    document.writeln('\'do a one-time test for a version of VBScript that can handle this code');
    document.writeln('detectableWithVB = False');
    document.writeln('If ScriptEngineMajorVersion >= 2 then');
    document.writeln('  detectableWithVB = True');
    document.writeln('End If');
    document.writeln('\'this next function will detect most plugins');
    document.writeln('Function detectActiveXControl(activeXControlName)');
    document.writeln('  on error resume next');
    document.writeln('  detectActiveXControl = False');
    document.writeln('  If detectableWithVB Then');
    document.writeln('     detectActiveXControl = IsObject(CreateObject(activeXControlName))');
    document.writeln('  End If');
    document.writeln('End Function');
    document.writeln('</scr' + 'ipt>');

	function slimstat_detectActiveXControl(progIds){
		for (var i = 0; i < progIds.length; i++) {
			if (detectActiveXControl(progIds[i])) return true;
		}
		return false;
	}
}

// Thanks to http://www.useragentman.com/blog/2009/11/29/how-to-detect-font-smoothing-using-javascript/
function slimstat_has_smoothing(){
	// IE has screen.fontSmoothingEnabled - sweet!
	if (typeof screen.fontSmoothingEnabled != 'undefined'){
		return screen.fontSmoothingEnabled;
	}
	else{
		try{
			// Create a 35x35 Canvas block.
			var canvasNode = document.createElement('canvas');
			canvasNode.width = "35";
			canvasNode.height = "35";

			// We must put this node into the body, otherwise
			// Safari Windows does not report correctly.
			canvasNode.style.display = 'none';
			document.body.appendChild(canvasNode);
			var ctx = canvasNode.getContext('2d');

			// draw a black letter 'O', 32px Arial.
			ctx.textBaseline = "top";
			ctx.font = "32px Arial";
			ctx.fillStyle = "black";
			ctx.strokeStyle = "black";

			ctx.fillText("O", 0, 0);

			// start at (8,1) and search the canvas from left to right,
			// top to bottom to see if we can find a non-black pixel.  If
			// so we return true.
			for (var j = 8; j <= 32; j++){
				for (var i = 1; i <= 32; i++){
					var imageData = ctx.getImageData(i, j, 1, 1).data;
					var alpha = imageData[3];

					if (alpha != 255 && alpha != 0) return true; // font-smoothing must be on.
				}
			}

			// didn't find any non-black pixels - return false.
			return false;
		}
		catch (ex){
			// Something went wrong (for example, Opera cannot use the
			// canvas fillText() method.  Return null (unknown).
			return null;
		}
	}
}

// Sends asynchronous requests to the server 
function slimstat_send_to_server(url, async){
	if (typeof slimstat_path == 'undefined' ||
		typeof slimstat_tid == 'undefined' ||
		typeof slimstat_session_id == 'undefined' ||
		typeof slimstat_blog_id == 'undefined' ||
		typeof url == 'undefined') return 0;

	if (typeof async == 'undefined') var async = true;
	try {
		request = new XMLHttpRequest();
	} catch (failed) {
		return false;
	}
	if (request) {
		request.open('GET', slimstat_path+'/wp-slimstat-js.php'+"?id="+slimstat_tid+"&sid="+slimstat_session_id+"&bid="+slimstat_blog_id+"&"+url, async);
		request.send(null);
		return true;
	}	
	return false;
}

function ss_te(e, c, deprecated, note){
	ss_track(e, c, note);
}

function ss_track(e, c, note){
	// Check function params
	if (typeof e == 'undefined') var e = window.event;
	code = (typeof c == 'undefined')?0:parseInt(c);
	if (typeof note == 'undefined') var note = '';

	var node = (typeof e.target != 'undefined')?e.target:((typeof e.srcElement != 'undefined')?e.srcElement:false);
	if (!node) return false;

	// Old Safari bug
	if (node.nodeType == 3) node = node.parentNode;

	// This function can be attached to click and mousedown events
	var async = false;
	var parent_node = node.parentNode;
	var node_hostname = '';
	var node_pathname = location.pathname;
	var slimstat_info = '';

	// This handler can be attached to any element, but only A carry the extra info we need
	switch (node.nodeName){
		case 'FORM':
			if (node.action.length > 0) node_pathname = escape(node.action);
			break;

		case 'INPUT':
			// Let's look for a FORM element
			while (typeof parent_node != 'undefined' && parent_node.nodeName != 'FORM' && parent_node.nodeName != 'BODY') parent_node = parent_node.parentNode;
			if (typeof parent_node.action != 'undefined' && parent_node.action.length > 0){
				node_pathname = escape(parent_node.action);
				break;
			}

		default:
			if (node.nodeName != 'A'){
				if (typeof node.getAttribute == 'function' && node.getAttribute('id') != 'undefined' && node.getAttribute('id') != null && node.getAttribute('id').length > 0){
					node_pathname = node.getAttribute('id');
					break;
				}
				while (typeof node != 'undefined' && node.nodeName != 'A' && node.nodeName != 'BODY') node = node.parentNode;
			}

			// Anchor in the same page
			if (typeof node.hash != 'undefined' && node.hash.length > 0 && node.hostname == location.hostname){
				async = true;
				node_pathname = escape(node.hash);
			}
			// Any other element
			else{
				// Wait for the server to respond
				node_hostname = (typeof node.hostname != 'undefined')?node.hostname:'';
				if (typeof node.href != 'undefined'){
					node_pathname = escape(node.href);
				}				
			}

			// If this element has an ID, we can use that for the note
			if (typeof node.getAttribute == 'function' &&
				(note.substring(0, 2) == 'A:' || note.length == 0) &&
				node.getAttribute('id') != 'undefined' &&
				node.getAttribute('id') != null &&
				node.getAttribute('id').length > 0) note = 'ID:'+node.getAttribute('id');
	}
	slimstat_info = "&obd="+node_hostname+"&obr="+node_pathname;

	// Track mouse coordinates
	var pos_x = -1; var pos_y = -1;
	if (typeof e.pageX != 'undefined' && typeof e.pageY != 'undefined'){
		pos_x = e.pageX;
		pos_y = e.pageY;
	}
	else if (typeof e.clientX != 'undefined' && typeof e.clientY != 'undefined' &&
			typeof document.body.scrollLeft != 'undefined' && typeof document.documentElement.scrollLeft != 'undefined' &&
			typeof document.body.scrollTop != 'undefined' && typeof document.documentElement.scrollTop != 'undefined'){
		pos_x = e.clientX+document.body.scrollLeft+document.documentElement.scrollLeft;
		pos_y = e.clientY+document.body.scrollTop+document.documentElement.scrollTop;
	}
	if (pos_x > 0 && pos_y > 0) slimstat_info += ((slimstat_info.length > 0)?'&':'?')+'po='+pos_x+','+pos_y;

	// Event type and button pressed
	note += '|ET:'+e.type;

	if (e.type != 'click' && typeof(e.which) != 'undefined'){
		if (e.type == 'keypress' )
			note += '|BT:'+String.fromCharCode(parseInt(e.which));
		else
			note += '|BT:'+e.which;
	}

	return slimstat_send_to_server("ty="+code+slimstat_info+"&no="+escape(note), async);
}

// Attach an event listener to all external links
var links_in_this_page = document.getElementsByTagName("a");
for (var i=0;i<links_in_this_page.length;i++){
	if ((typeof slimstat_heatmap == 'undefined') &&
		((links_in_this_page[i].hostname == location.hostname) ||
		 (links_in_this_page[i].href.indexOf('://') == -1) ||
		 (links_in_this_page[i].className.indexOf('noslimstat') != -1))) continue;

	if (links_in_this_page[i].addEventListener)
		links_in_this_page[i].addEventListener("click", function(i){ return function(e){ ss_track(e,0,"A:"+(i+1)) } }(i), false);
	else if (links_in_this_page[i].attachEvent)
		links_in_this_page[i].attachEvent("onclick", function(i){ return function(e){ ss_track(e,0,"A:"+(i+1)) } }(i));
}

// Track Google+1 clicks
function slimstat_plusone(obj){
	slimstat_send_to_server('ty=4&obr='+escape('#google-plus-'+obj.state), true);
}

// Gather all the information and send it to the server
slimstat_info = "sw="+(window.innerWidth||document.documentElement.clientWidth||document.body.offsetWidth)+"&sh="+(window.innerHeight||document.documentElement.clientHeight||document.body.offsetHeight)+"&cd="+screen.colorDepth+"&aa="+(slimstat_has_smoothing()?'1':'0')+"&pl=";
for (var slimstat_alias in slimstat_plugins){
	if (slimstat_detect_plugin(slimstat_plugins[slimstat_alias].substrs) || (detectableWithVB && slimstat_detectActiveXControl(slimstat_plugins[slimstat_alias].progIds))){
		slimstat_info += slimstat_alias +"|";
	}
}
slimstat_send_to_server(slimstat_info);