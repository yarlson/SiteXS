<?php
include "lib/adm.class.php";
$db=new sql;
switch ($action) {
	case 'create':
		$db->connect();
		$res=$db->query("show columns from $table");
		$caption="Класс $table.class.php успешно создан!";
		$content="&nbsp;";
		$f=fopen("templates/class.php", "r");
		while (!feof ($f)) {
		    $class.= fgets($f, 1024);
		}
		$class=str_replace("\$table", $table, $class);
		echo $class;
		break;
	case 'select':
		$db->connect();
		$res=$db->query("show columns from $table");
		$caption="Выбор свойств полей";
		$action="create";
		$content="<input type=\"hidden\" name=\"table\" value=\"$table\">";
		$content.="<table cellspacing=\"0\" cellpadding=\"5\">\n";
		$content.="<th>Поле</th><th>Описание</th><th>Выводить в общем списке</th><th>Выводить в свойствах</th><th>Обязательное</th><th><nobr>E-mail</nobr></th><th>Дата</th>\n";
		$res=$db->query("show columns from $table");
		while ($data=$db->fetch_array($res)) {
			$content.="<tr><td><strong>".$data["Field"]."</strong></td><td><input type=\"text\" name=\"name[".$data["Field"]."]\"></td>".(($data["Extra"]=="auto_increment") ? "\n" : "<td><input type=\"checkbox\" name=\"list[".$data["Field"]."]\" value=\"1\"></td><td><input type=\"checkbox\" name=\"prop[".$data["Field"]."]\" value=\"1\" checked></td><td><input type=\"checkbox\" name=\"req[".$data["Field"]."]\" value=\"1\"></td><td><input type=\"checkbox\" name=\"email[".$data["Field"]."]\" value=\"1\"></td><td><input type=\"checkbox\" name=\"date[".$data["Field"]."]\" value=\"1\"></td></tr>\n");
		}
		$content.="</table>";
		eval('$content="'.admin::template("wizard").'";');
		echo $content;
		break;
	default:
		$db->connect();
		$res=$db->query("show tables");
		$action="select";
		$caption="Вас приветствует мастер создания классов!";
		$content="Выберите таблицу <select name=\"table\">";
		while ($data=$db->fetch_array($res)) {
			$content.="<option value=\"".$data["Tables_in_".$DB["dbName"]]."\">".$data["Tables_in_".$DB["dbName"]]."</option>";
		}
		$content.="</select>";
		eval('$content="'.admin::template("wizard").'";');
		echo $content;
		break;
}
?>