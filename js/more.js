/***
 * Title	: show layers
 * Date		: 26/12/2007
 * Author	: Mohd Remi Asmuni (remiglobal@gmail.com)
 * Notes	: -
 */

function showLayer(id) {
	//alert("show "+id);
	document.getElementById(id).style.display = 'block';
	document.getElementById("min"+id).style.display = 'block';		
	document.getElementById("max"+id).style.display = 'none';		

} 

function hideLayer(id) {
	//alert("hide "+id);
	document.getElementById(id).style.display = 'none';
	document.getElementById("min"+id).style.display = 'none';		
	document.getElementById("max"+id).style.display = 'block';		
}

function toggleLayer(id) {

	var e = document.getElementById(id);
	if(e.style.display == 'none') {
		e.style.display = 'block';
		//Effect.SlideDown(id,{duration:3});
		//window.setTimeout('Effect.Appear(id, {duration:.3})',2500);
	} else {
		e.style.display = 'none';
		//Effect.SlideUp(id,{duration:3});
	}
}