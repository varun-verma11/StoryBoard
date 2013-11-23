function add_page() {
	var url = document.location.href
	url += "&addpage=true";
	location.href = url;
}

function delete_page() {

	var url = document.location.href
	url += "&delete=true";
	location.href = url;
}