/* Write here your custom javascript codes */

var getXsrfToken = function() {
    var cookies = document.cookie.split(';');
    var token = '';

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].split('=');
        if(cookie[0] == 'XSRF-TOKEN') {
            token = decodeURIComponent(cookie[1]);
        }
    }

    return token;
}

jQuery.ajaxSetup({
    headers: {
        'X-XSRF-TOKEN': getXsrfToken()
    }
});