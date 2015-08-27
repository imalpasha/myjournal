/***
 * Title	: window onload events functions for all browsers
 * Date		: 26/12/2007
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: million thanks to Dean Edwards/Matthias Miller/John Resig
 */

function init() {
	
  // quit if this function has already been called
  if (arguments.callee.done) return;

  // flag this function so we don't do the same thing twice
  arguments.callee.done = true;

  // kill the timer
  if (_timer) clearInterval(_timer);

  /* start of customized onload codes */
  
  // create dnd instance
  Sortable.create('sortableList',{tag:'div'});
  // reflex sort items with proxyItems, 
  // this should be put inside a config file or be stored in db permanently
  //reflexPortlets();
  // make sure that all input fields can be clicked / edited
  forceFieldEdit();
  Nifty("div#roundedBox","big");  
   /* end of customized onload codes */

};

/* for Mozilla/Opera9 */
if (document.addEventListener) {
  document.addEventListener("DOMContentLoaded", init, false);
}

/* for Internet Explorer */
/*@cc_on @*/
/*@if (@_win32)
  document.write("<script id=__ie_onload defer src=javascript:void(0)><\/script>");
  var script = document.getElementById("__ie_onload");
  script.onreadystatechange = function() {
    if (this.readyState == "complete") {
      init(); // call the onload handler
    }
  };
/*@end @*/

/* for Safari */
if (/WebKit/i.test(navigator.userAgent)) { // sniff
  var _timer = setInterval(function() {
    if (/loaded|complete/.test(document.readyState)) {
      init(); // call the onload handler
    }
  }, 10);
}

/* for other browsers */
window.onload = init;
