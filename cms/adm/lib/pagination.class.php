<?php

class pagination {

	function pagination ($curUrl, $curPage, $recPerPage, $totalCount, $tableName="", $fieldName="", $where="") {
		$this->url=$curUrl;
		$this->page=($curPage) ? $curPage : 1;
		$this->recPerPage=$recPerPage;
		if ($totalCount) {
			$this->totalRecCount=$totlaCount;
		}
		else {
			$db= new sql;
			$db->connect();
			$db->query("select count($fieldName) as rec_count from $tableName $where");
			$data=$db->fetch_array($db->result);
			
			$this->totalRecCount=$data["rec_count"];
		}
	}

	function limit() {
		return "LIMIT ".(($this->page-1)*$this->recPerPage).", ".$this->recPerPage;
	}

	function bar () {
		$pageCount=ceil((($this->totalRecCount)/$this->recPerPage));
		if ($pageCount>1)	
		{
			$result="<p class=\"pagebar\">Перейти к странице:&nbsp;";
			for ($i=0; $i<$pageCount;$i++)
			{
				if ($i==($this->page-1)):
					$result.= "&nbsp;<b>".($i+1)."</b>";
				else:
					$result.= "&nbsp;[<a href=".$this->url."page=".($i+1).">".($i+1)."</a>]";
				endif;
			}
			$result.="</p>";
		}
		return $result;
	}

	function shift () {
		return ($this->page-1)*$this->recPerPage;
	}
}
?>