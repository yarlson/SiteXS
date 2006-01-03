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
		if (!$tr) $tr="<p style=\"font-size: 0.85em;\">� ��������� ����� � ������ ��������� ������ �� ������.</p><p style=\"font-size: 0.85em;\"><a href=\"/request/\">������</a> ����������� �� 15 ������� 2004 ����</p>";
		$resultTr.=$tr;
		if ($resultTr) eval('$projectsMain.="'.page::template("modules/resultMain").'";');
		$resultTr="";
		
		if (time() <1098388800) {
			$text="<p>����� ��������� ������� ���������� �����������, ������������� � ������ ��������� �������.</p><p>��� ����, ����� ������������� �� ������ ���� ������� �� ��� ��������.</p><p>�� ������ ��������� ���� ������ ������� �� 22 �������������� ��������, �� ������ ������� ��� ������ 1 ��� �� ���� ������ �����������.</p><p>����������� ������� �� 0:00 22 ������� 2004 ����.</p>";
		}
		else {
			$text="<h3>��������� ������� �&nbsp;0:00 22&nbsp;������� 2004&nbsp;����.</h3><p><i>��� ������� ���� ����������� ��&nbsp;������� �&nbsp;���������, ���������� �������� �2.&nbsp;�����&nbsp;���&nbsp;2004. ��������� �������������� ������ ��������������� ��� ����������� ������ 0&nbsp;������. �&nbsp;����� ��������� ������������� ������ �����������, ���������� ������ ������� ��&nbsp;��������� ������ 0&nbsp;������, ������������ ��&nbsp;���� ������ ����������� �&nbsp;���������.</i></p>";
		}
		$this->elements["content"]=$text.$projectsMain;
	}

}
?>