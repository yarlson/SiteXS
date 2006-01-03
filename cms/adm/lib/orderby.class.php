<?php

class orderBy {

	function orderBy ($url, $fieldsArray, $default, $field, $order="", $urlFields="") {
		$this->url=$url;
		$this->fieldsArray=$fieldsArray;
		$this->order=$order;
		$this->field=$field;
		$this->urlFields=(is_array($urlFields)) ? $urlFields : array("field", "order");
		if (!$this->field) {
			$keys=array_keys($default);
			$this->field=$keys[0];
			if ($default[$this->field]) $this->order=$default[$this->field];
		}
	}

	function orderByQuery() {
		return " ORDER BY ".$this->field." ".$this->order;
	}

	function orderByQueryShort() {
		return " ,".$this->field." ".$this->order;
	}	

	function bar () {
		$ths=$this->ths();
		foreach ($ths as $key => $value) {
			$result.="<th>".$value."</th>";
		}
		return $result;
	}

	function ths() {
		foreach ($this->fieldsArray as $key => $value) {
			$im = ($this->order=="desc") ? "desc" : "asc";
			$icon = ($this->field==$key) ? "<img src=\"i/$im.gif\" alt=\"\" width=\"8\" height=\"10\" border=\"0\" hspace=\"3\">" : "<img src=\"i/dot.gif\" alt=\"\" width=\"8\" height=\"10\" border=\"0\" hspace=\"3\">";
			$order= ($this->field==$key && (!$this->order || $this->order=="asc")) ? "&".$this->urlFields[1]."=desc" : "";
			$result[]="<nobr><a href=\"".$this->url.$this->urlFields[0]."=$key$order\">".$value."$icon</a></nobr>";
		}
		return $result;
	}

	function urlForPage() {
		return $this->url.(($this->field) ? $this->urlFields[0]."=".$this->field."&".(($this->order) ? $this->urlFields[1]."=".$this->order."&" : "") : "");
	}

}
?>