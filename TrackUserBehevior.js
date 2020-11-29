var timerStart = (new Date).getTime();


function scroll_percentage() {
	var doc = document.documentElement;
	// var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
	var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
	// var top = window.pageYOffset || document.documentElement.scrollTop;

	if(page_maxScroll == 0) 
		return 0;
	return Math.round(top/page_maxScroll*100);
}




// What happen when user change the page. (Error When Page reload)		
window.onunload = function() {
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
        url: 'session_urls.php',

        data: {
        	'user_stay_time': user_stay_time,
			'user_scroll_unload': user_scroll_unload,
			'url': url,
			'ref': ref,
        },
        success: function(data) {
        	// alert(data);
        },

    });
};
