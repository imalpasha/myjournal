// usage javascript:popUp('home_audit.php?type=undi')

function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=0,width=800,height=600,left = 412,top = 284');");
}