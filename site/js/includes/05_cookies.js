$(document).ready(function(){

// Explore Page Tab Cookies
/* removal of explore tab cookie remember which one was on last.
  $('#exploreTabs .nav-tabs a').click(function() {
		var tabID = $(this).attr('data-tabID');
		Cookies.set('exploreTab', tabID, {path: ''});
	});

	if (Cookies.get('exploreTab')) {
	  var lastTabID = Cookies.get('exploreTab');
		var splitID1 = lastTabID.split('')[0];
		var splitID2 = lastTabID.split('')[1];
		
		if (splitID2 !== 0) {
		  var parentTabID = splitID1+'0';
		  var parentTab = $('#exploreTabs').find('a[data-tabID="'+parentTabID+'"]');
			$(parentTab).tab('show');
		}
		var lastTab = $('#exploreTabs').find('a[data-tabID="'+lastTabID+'"]');
		$(lastTab).tab('show');
	} 
*/
// Tooltip Pulse Cookies

//  if (!Cookies.get('pageSeen')) {
//	  $('.tipIcon').addClass('pulse');
//	}
//
//  Cookies.set('pageSeen', '1', {path: ''});

  var seenIcons = [];

  if (Cookies.get('seenIcons')) {
    seenIcons = Cookies.get('seenIcons');
		seenIcons = seenIcons.split(',');
		//console.log(seenIcons);
  }
	
	$('.tipIcon').each(function() {
	  var iconID = $(this).attr('data-tooltip-content');
		if (!seenIcons.includes(iconID)) {
		  $(this).addClass('pulse');
			//console.log('Fail '+iconID);
		} else {
		  //console.log('Match '+iconID);
		}		
	});
	
	$('.tipIcon').each(function() {
	  seenIcons.push($(this).attr('data-tooltip-content'));
	});
	
  seenIcons = seenIcons.filter(function(elem, index, self) {
    return index === self.indexOf(elem);
  });
	
	//console.log('All '+seenIcons);	
	
	Cookies.set('seenIcons', seenIcons);

});

// Set/ get cookies 
function setCookie(cname, cvalue, exdays) {
	const d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	let expires = "expires=" + d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	let name = cname + "=";
	let ca = document.cookie.split(';');
	for (let i = 0; i < ca.length; i++) {
		let c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function CookiesAccepted() {
	let cbAcc = getCookie("cookiesAccept");
	if (cbAcc != "") {
		$("#cookieBanner").hide();
	} else {
		$("#cookieBanner").show();
	}
}
