<?php
class votelist {

	function votelist() {
	}

	function content() {
		$db=new sql;
		$db->connect();
		if (time() <1098388800) {
			$res=$db->query("select projects.id, name, company, category, sum(IF(grade is null,0, grade))/count(IF(grade is null,0, grade)) as gsum, count(grade) as gcount FROM projects left join votes on projects.id=votes.id group by projects.id, name, company, category order by gsum desc");
		}
		else {
			$res=$db->query("select projects.id, name, company, category, sum(IF(grade is null,0, grade))/count(IF(grade is null,0, grade)) as gsum, count(grade) as gcount FROM projects left join votes on projects.id=votes.id where grade>0 group by projects.id, name, company, category order by gsum desc");
		}
		$cats=array(1=>"A", "C", "Y");
		$tr="";
		while ($data=$db->fetch_array($res)) {
			$res1=$db->query("select * from categories where category_id=$data[category]");
			$data1=$db->fetch_array($res1);
			$url="/projects/".$cats[$data1["category_id"]]."/";
			eval('$tr.="'.page::template("modules/resultTR").'";');
		}
		if (!$tr) $tr="<p style=\"font-size: 0.85em;\">В настоящее время в данной номинации заявок не подано.</p><p style=\"font-size: 0.85em;\"><a href=\"/request/\">Заявки</a> принимаются до 15 октября 2004 года</p>";
		$resultTr.=$tr;
		if ($resultTr) eval('$projectsMain.="'.page::template("modules/resultMain").'";');
		$resultTr="";
		
		if (time() <1098388800) {
			$text="<p>Здесь размещены текущие результаты голосования, обновляющиеся в режиме реального времени.</p><p>Для того, чтобы проголосовать за проект надо перейти на его страницу.</p><p>Вы можете поставить свою оценку каждому из 22 представленных проектов, но можете сделать это только 1 раз за весь период голосования.</p><p>Голосование открыто до 0:00 22 октября 2004 года.</p>";
		}
		else {
			$text="<h3>Голование закрыто в&nbsp;0:00 22&nbsp;октября 2004&nbsp;года.</h3><p><i>При анализе хода голосования за&nbsp;проекты в&nbsp;интернете, Оргкомитет конкурса М2.&nbsp;Новый&nbsp;Дом&nbsp;2004. обнаружил многочисленные случаи злоупотребления при выставлении оценки 0&nbsp;баллов. В&nbsp;целях повышения релевантности итогов голосования, Оргкомитет принял решение не&nbsp;учитывать оценки 0&nbsp;баллов, выставленные за&nbsp;весь период голосования в&nbsp;интернете.</i></p>";
		}
		$this->elements["content"]=$text.$projectsMain;
	}

}
?>