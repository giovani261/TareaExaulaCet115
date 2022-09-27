function irArriba(pixeles) {
	// body...
	window.addEventListener("scroll", () => {
		var scroll = document.documentElement.scrollTop;
		//console.log(scroll);

		if(scroll > pixeles){
			btnSubir.style.right = 20 + "px";
		}
		else{
			btnSubir.style.right = -100 + "px";
		}
	})
}
irArriba(300);

$(window).on('hashchange', function(e){
    history.replaceState ("", document.title, e.originalEvent.oldURL);
});
