function delete_onclick(name) {
	var thisCheckBoxes=document.getElementsByTagName("input");
	var files="";
	var names="";
	var j=0;
	for (i = 1; i < thisCheckBoxes.length; i++){
		if (thisCheckBoxes[i].name=="ids") {
			if (thisCheckBoxes[i].checked) {
				j++;
				files+="&name[]="+thisCheckBoxes[i].value;
				names+="\n"+thisCheckBoxes[i].value.replace("\/", "");
			}
		}
	}
	if (j)
		if (confirm("УДАЛИТЬ "+((j==1) ? "ФАЙЛ" : "ФАЙЛЫ")+ ":" + names+"?")) document.location="?chid=" + chid + "&dir="+cur_dir+"&action=delete&name="+files;
	return false;
}

function rename_onclick(){
	var thisCheckBoxes=document.getElementsByTagName("input");
	for (i = 1; i < thisCheckBoxes.length; i++){
		if (thisCheckBoxes[i].name=="ids") {
			if (thisCheckBoxes[i].checked) {
				var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\">э</a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\">Переименовать</h1><form action=\"?chid=" + chid + "&action=rename&from=" + thisCheckBoxes[i].value.replace('\/', "") + "&dir="+cur_dir+"\" name=\"FP\" method=\"post\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td>Старое&nbsp;название&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\">" + thisCheckBoxes[i].value.replace('\/', "") + "</td><td></td></tr><tr><td>Новое&nbsp;название&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"to\" maxlength=\"30\" size=\"30\" value=\"" + thisCheckBoxes[i].value.replace('\/', "") + "\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\">Не более 30 знаков. Только латинские буквы, цифры, знак подчеркивания (_) и дефис (-)</td></tr><tr><td colspan=\"2\"><input type=\"submit\" value=\"Сохранить\">&nbsp;<input type=\"button\" value=\"Отменить\" onClick=\"mb.style.display='none';\"></td></tr></table></form><script>document.FP.name.focus();</script>";
				openWnd(400, html);
				break;
			}
		}
	}
}

function add_onclick(){
	var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\">э</a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\">Новая папка</h1><form action=\"#\" name=\"FORMPOST\" onsubmit=\"return false;\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td>Название&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"name\" maxlength=\"30\" size=\"30\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\">Не более 30 знаков. Только латинские буквы, цифры, знак подчеркивания (_) и дефис (-)</td></tr><tr><td colspan=\"2\"><input type=\"button\" value=\"Сохранить\" onClick=\"if (FORMPOST.name.value) {window.location='?chid=" + chid + "&action=addNewDir&name='+FORMPOST.name.value+'&dir="+cur_dir+"';}\">&nbsp;<input type=\"button\" value=\"Отменить\" onClick=\"mb.style.display='none';\"></td></tr></table></form>";
	openWnd(400, html);
}

function upload_onclick(){
	var html="<div align=\"right\"><a href=\"\" style=\"font-family: wingdings; color: silver; text-decoration: none;font-size: 20px;\" onclick=\"mb.style.display='none';return false;\">э</a></div><h1 style=\"background: #EFEFE4; font-size: 140%; font-weight: normal;padding: 5px\" id=\"bd\">Загрузить&nbsp;новый&nbsp;файл</h1><form action=\"?chid=" + chid + "&action=upload&dir="+cur_dir+"\" name=\"FORMPOST\" onsubmit=\"document.all.bd.innerHTML='Идет загрузка...';\" method=\"post\" enctype=\"multipart/form-data\"><table cellspacing=\"0\" cellpadding=\"5\" class=\"noborder\"><tr><td>Выберите&nbsp;файл&nbsp;&nbsp;&nbsp;</td><td valign=\"top\" width=\"100%\"><input name=\"pic\" maxlength=\"30\" size=\"30\" type=\"File\"></td><td></td></tr><tr><td style=\"font-size: 80%;font-family: tahoma; color: gray;\" colspan=\"2\">Не более 30 знаков. Только латинские буквы, цифры, точка (.), знак подчеркивания (_) и дефис (-)</td></tr><tr><td colspan=\"2\"><input type=\"submit\" value=\"Сохранить\">&nbsp;<input type=\"button\" value=\"Отменить\" onClick=\"mb.style.display='none';\"></td></tr></table></form>";
	openWnd(440, html);
}