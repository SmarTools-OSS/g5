function windowOpen(url, width, height, scroll, left, top) 
{
	scroll = (scroll ? scroll : "yes");
	left = (typeof left=="undefined")? ((screen.width/2 - width/2) -15): left;
	top = (typeof top=="undefined")? ((screen.height/2 - height/2) -25): top;
	window.open(url, "nc_popup", "left="+left+",top="+top+",width="+width+",height="+height+",scrollbars="+scroll+",toolbar=no,location=no,directories=no,status=no,menubar=no,resizable=no");
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
function setCookie(cname, cvalue, exhous, path, domain) {
    var d = new Date();
    d.setTime(d.getTime() + (exhous*60*60*1000));
    var expires = "expires="+d.toUTCString();
	var cookie = cname + "=" + cvalue + "; " + expires;
	if( path ) cookie += "; path=" + path;
	if( domain ) cookie += "; domain=" + domain;
    document.cookie = cookie;
}
function delCookie(cname, path, domain)
{
	var d = new Date();
	d.setTime(d.getTime() - (24*60*60*1000));
    var expires = "expires="+d.toUTCString();
	var cookie = cname + "=" + cvalue + "; " + expires;
	if( path ) cookie += "; path=" + path;
	if( domain ) cookie += "; domain=" + domain;
    document.cookie = cookie;
}
function numFormat(val, round_decimal) {
	round_decimal = (typeof round_decimal=="undefined")? 0: round_decimal;
	return Number(val).toFixed(round_decimal).replace(/(\d)(?=(\d{3})+$)/g, "$1,");
}