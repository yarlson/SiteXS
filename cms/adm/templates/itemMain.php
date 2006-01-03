<script language="JavaScript">
<!--
var ie=document.all;
var nn6=document.getElementById&&!document.all;
var isdrag=false;
var x,y;
var dobj;
var feid, eid;
var id=$lid;

function movemouse(e) {
	if (isdrag) {
		dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
		dobj.style.top = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
		return false;
	}
}

function selectmouse(e) {
	var fobj = nn6 ? e.target : event.srcElement;
	feid=fobj.id.substring(4);
	var topelement = nn6 ? "HTML" : "BODY";
	while (fobj.tagName != topelement && fobj.className != "dragme") {
		fobj = nn6 ? fobj.parentNode : fobj.parentElement;
	}
	if (fobj.className=="dragme") {
		isdrag = true;
		x = nn6 ? e.clientX : event.clientX;
		y = nn6 ? e.clientY : event.clientY;
		dobj = document.createElement("div");
		dobj.className="dragme";
		dobj.style.position="absolute";
		dobj.style.border="1px solid silver";
		dobj.style.padding="0.2em";
		dobj.style.background="white";
		dobj.style.left = x+1;
		dobj.style.top = y+1;
		dobj.innerHTML = nn6 ? fobj.parentNode.innerHTML : fobj.parentElement.innerHTML;
		dobj.onmouseup=removemouse;
		tx = parseInt(dobj.style.left+0);
		ty = parseInt(dobj.style.top+0);
		document.onmousemove=movemouse;
		document.body.appendChild(dobj);
		return false;
	}
}
function removemouse(e) {
	if (dobj) {
		var fobj = nn6 ? e.target : event.srcElement;
		var topelement = nn6 ? "HTML" : "BODY";
		while (fobj.tagName != topelement && fobj.className != "dragme") {
			fobj = nn6 ? fobj.parentNode : fobj.parentElement;
		}
		isdrag = false;
		var x1 = nn6 ? e.clientX : event.clientX;
		var y1 = nn6 ? e.clientY : event.clientY;
		var eid = fobj.id.substring(4);
		
		if ((eid && feid) && (eid!=feid)) {
			window.location="./index.php?chid=$chid&action=reorder&eid=" + eid + "&feid=" + feid + "&id=" + id;
		}		
		document.body.removeChild(dobj);
		dobj = null;
	}
}
document.onmousedown=selectmouse;
document.onmouseup=removemouse;

function submit_delete()	{
	return confirm('<?php echo __("Delete selected record") ?>?');
}
</script>
<p><a href="?chid=$chid&action=add&pid=0&level=1&lid=$lid"><img src="i/add.gif" alt="<?php echo __("Add") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php echo __("Add") ?></a></p>
<table width="100%">
<tr>
	<th width="80%"><?php echo __("Title") ?></th><th width="10%"><?php echo __("Size") ?></th><th width="10%"></th><th><?php echo __("Action") ?></th>
</tr>
$content
</table>

<br>

