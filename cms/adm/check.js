function CheckAll(Element,Name){
if(document.getElementById) {
	thisCheckBoxes = Element.parentNode.parentNode.parentNode.parentNode.getElementsByTagName('input');
	for (i = 1; i < thisCheckBoxes.length; i++){
		if (thisCheckBoxes[i].name == Name){
			thisCheckBoxes[i].checked = Element.checked;
			Colorize(document.getElementById(thisCheckBoxes[i].id.replace('cb','tr')), thisCheckBoxes[i]);
		}
	}
	}
}

function Colorize(Element, CBElement){
if(document.getElementById) {
	if(Element && CBElement){
		Element.className = ( CBElement.checked ? 'selected' : 'default' );
	}
}
}

function CheckRadioTR(Element){
if(document.getElementById) {
	CheckTR(Element);
	thisTRs = Element.parentNode.getElementsByTagName('tr');
	for (i = 0; i < thisTRs.length; i++){
		if (thisTRs[i].id != Element.id && thisTRs[i].className != 'header') thisTRs[i].className = 'default';
	}
}
}

function CheckTR(Element){
if(document.getElementById) {
	thisCheckbox = document.getElementById(Element.id.replace('tr','cb'));
	thisCheckbox.checked = !thisCheckbox.checked;
	Colorize(Element, thisCheckbox);
}
}

function CheckCB(Element){
if(document.getElementById) {
	if(document.getElementById(Element.id.replace('cb','tr'))){Element.checked = !Element.checked;}
}
}