function openWnd(width, html){
	mb=document.getElementById("messagebox");
	mb.style.position="absolute";
	mb.style.left="30%";
	mb.style.width=width+"px";
	mb.style.display="block";
	mb.innerHTML=html;
}