
window.onload = initAll;
//globals - I  don't know how to pass them because of showContents
var xhr = false;
var xPos, yPos;

function initAll() {
	var allLinks = document.getElementsByTagName("a");
	//console.log("Hello Console");
	
	for (var i=0; i< allLinks.length; i++) {
		// add a listener to each link on the page
		allLinks[i].onmouseover = showPreview;
	}
}	
	
function showPreview(evt) {
    //console.log("inside showPreview(%s)", evt);
	if (evt) {
		// as you hover over a link, get its target
		var url = evt.target;
	} else {
		// do this for browser that don't pass the evt
		evt = window.event;
		var url = evt.srcElement;
	}
	xPos = evt.clientX;
	yPos = evt.clientY;
	//console.log("xPos: %s", xPos);

	if (window.XMLHttpRequest) {
		xhr = new XMLHttpRequest();
	} else {
		if(window.ActiveObject) {
			try {
					xhr = new ActiveXObject("Micro.XMLHTTP");
				}
				catch (e) {}	
		}
		
	}
	
	if (xhr) {
		// anytime the ready state changes call showContents
		xhr.onreadystatechange = showContents;
		// call the server async to get the data
		xhr.open("GET", url, true);
		xhr.send(null);
	}
	else {
		alert("Unable to create an XMLHttpRequest");
	
	}	
}

function showContents() {
	
	// do the response for the ready state change
	
	// all is good with response so far
	if (xhr.readyState == 4) {
		// 200 means we found the file
		if (xhr.status == 200) {
		    // get the text version of the XMLHttpRequest
			var outMsg = xhr.responseText;
			
		} else {
			var outMsg = "There was a problem with the request " + xhr.status;
		}
		// build the preview window
		var prevWin = document.getElementById("previewWin");
		// style and load the box
		prevWin.innerHTML = outMsg;
		// position the box
		prevWin.style.top = parseInt(yPos)+2 + "px";
		prevWin.style.left = parseInt(xPos)+2 + "px";
		prevWin.style.visibility = "visible";
		// add another listener to make the box disappear
		prevWin.onmouseout= function() {
			document.getElementById("previewWin").style.visibility = "hidden";
		};
	}
}
