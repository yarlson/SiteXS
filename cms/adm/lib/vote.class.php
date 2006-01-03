<?php
class vote {

	function vote () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->field=$HTTP_GET_VARS["field"];
		$this->order=$HTTP_GET_VARS["order"];
		$this->page=$HTTP_GET_VARS["page"];
		$this->type=$HTTP_GET_VARS["type"];
		$this->fields=$HTTP_POST_VARS["fields"];
		$this->author=$HTTP_POST_VARS["author"];
		$this->date=$HTTP_POST_VARS["date"];
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		
		$chid=$this->chid;
		
		include "lib/pagination.class.php";
		include "lib/orderby.class.php";
		
		$adminConfig=admin::adminConfig();
		for ($i=1; $i<4; $i++) {
			$voteTR="";
			$orderBy=new orderBy("?chid=".$this->chid."&", array("id"=>"№", "time"=>"Дата", "name"=>"Заголовок", "company"=>"Компания", "gsum"=>"Средний бал", "gcount"=>"Проголосовало"), array("gsum"=>"desc"),$this->field[$i], $this->order[$i], array("field[$i]", "order[$i]"));
			$pagination=new pagination ($orderBy->urlForPage(), $this->page, $adminConfig["recPerPage"], '', "projects", "id");
			$res=$db->query("select projects.id, name, company, category_name, date, sum(IF(grade is null,0, grade))/count(IF(grade is null,0, grade)) as gsum, count(grade) as gcount FROM (projects LEFT JOIN categories ON projects.category = categories.category_id) left join votes on projects.id=votes.id where category=$i group by projects.id, name, company, category_name, date ".$orderBy->orderByQuery()." ".$pagination->limit());
			$page =($this->page) ? "&page=".$this->page : "";
			while ($data=$db->fetch_array($res)) {
				$data["date"]=date("d.m.Y", $data["date"]);
				eval('$voteTR.="'.admin::template("voteTR").'";');
			}
			$pageBar=$pagination->bar();
			
			$th=$orderBy->bar();
			eval('$content.="'.admin::template("voteMain").'";');
			$content.="<br>";
		}
		
		$this->elements["content"]=$content;
	}

}
?>