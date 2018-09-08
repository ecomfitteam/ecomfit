var ecomfit_info_website = {
	domain: document.domain,
	url: document.URL,
	location_href : document.location.href,
	location_origin : document.location.origin,
	location_hostname : document.location.hostname,
	location_host : document.location.host,
	location_pathname : document.location.pathname
};

function ecomfitLoginParent(webId) {
	var form = document.createElement("form");
	var webIdElement = document.createElement("input");

	form.method = "POST";
	form.action = window.location.href;

	webIdElement.value = webId;
	webIdElement.name = 'webId';
	webIdElement.type = 'hidden';
	form.appendChild(webIdElement);

	document.body.appendChild(form);

	form.submit();
}


var ecomfit_interval;
function ecomfitOpenChildWindow(url_ecomfit) {
	var urlPopup = url_ecomfit + '/auth/login?platform=1&&domain=' + ecomfit_info_website.domain;
	var child = window.open(urlPopup,'Ratting','width=800,height=600,0,status=0');
	ecomfit_interval = setInterval(function(){
		child.postMessage({ message: "requestResult"}, "*");
	}, 500);
}

window.addEventListener("message", function(event) {
	if (event.data.message === "deliverResult") {
		var data = event.data.result.data;
		var webId = '';
		if (data.webId !== undefined) {
			webId = data.webId;
		}
		ecomfitLoginParent(webId);
		event.source.close();
		clearInterval(ecomfit_interval);
	}
});
