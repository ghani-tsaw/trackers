var page_maxScroll =  window.scrollMaxY || (document.documentElement.scrollHeight - document.documentElement.clientHeight);
var user_maxScroll = 0;
var page_ready_time = 0;
var page_load_time = 0;


// Page is completly loaded
window.onload = function() {
	page_load_time = (new Date).getTime()-timerStart;
};

// Calculate the page loading time.
$(document).ready(function() {
	page_ready_time = (new Date).getTime()-timerStart;

 });


$(window).scroll(function() {
	user_scroll_percentage = scroll_percentage();
	if(user_maxScroll < user_scroll_percentage) {
		user_maxScroll = user_scroll_percentage;
	}

});

function scroll_percentage() {
	var doc = document.documentElement;
	// var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
	var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
	// var top = window.pageYOffset || document.documentElement.scrollTop;

	var user_scroll_percentage = Math.round(top/page_maxScroll*100);
	return user_scroll_percentage;
}




// What happen when user change the page. (Error When Page reload)		
// window.onunload = function() {
$("#c").click(function() {	
	var user_stay_time = (new Date).getTime() - timerStart;
	var user_scroll_unload = scroll_percentage();
	var url = window.location.pathname; 
	
	var ref = document.referrer;
	// window.location.hash: "#2"
	// window.location.host: "localhost:4200"
	// window.location.hostname: "localhost"
	// window.location.href: "http://localhost:4200/landing?query=1#2"
	// window.location.origin: "http://localhost:4200"
	// window.location.pathname: "/landing"
	// window.location.port: "4200"
	// window.location.protocol: "http:"
	// window.location.search: "?query=1"

	// send these parameters to store in backend using ajax
	$.ajax({
        type: 'post',
        async: false,
        url: 'trackers/session_urls.php',

        data: {
			'page_load_time': page_load_time,
        	'page_ready_time': page_ready_time,
        	'user_stay_time': user_stay_time,
			'user_maxScroll': user_maxScroll, 
			'user_scroll_unload': user_scroll_unload,
			'url': url,
			'ref': ref,
        },
        success: function(data) {
        	// alert(data);
        },

    });
// };
});
