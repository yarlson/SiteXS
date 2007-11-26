<?php
class vote {

	function vote($id=0, $color, $IP="", $cookie="") {
		$this->id=$id;
		$this->color=$color;
		$this->IP=$IP;
		$this->cookie=$_COOKIE["voteID"];
		$this->grade["min"]=1;
		$this->grade["max"]=10;
		$this->db=new sql;
	}

	function show () {
		if ($this->voted()) $result=$this->showResults();
		else $result=$this->showBar();
		return $result;
	}

	function voted() {
			$this->db->connect();
			if ($_COOKIE["voteID"][$_POST["id"]])
				$res=$this->db->query("select * from votes where cookie='".$_COOKIE["voteID"][$_POST["id"]]."' and id='".$this->id."'");
			else
				$res=$this->db->query("select * from votes where ((IP='".$_SERVER["REMOTE_ADDR"]."' and xIP='".$_SERVER["HTTP_X_FORWARDED_FOR"]."')) and id='".$this->id."'");
			return ($this->db->num_rows($res)>0);
	}

	function showResults() {
		$page=new page;
		$this->db->connect();
		if (time() <1098388800) {
			$res=$this->db->query("select sum(grade)/count(grade) as gsum from votes where id=$this->id");
		}
		else {
			$res=$this->db->query("select sum(grade)/count(grade) as gsum from votes where grade>0 and id=$this->id");
		}
		$data=$this->db->fetch_array($res);
		$count=ceil($data["gsum"]*10)/10;
		$widthRes=(int)$count*15;
		$widthResGray=(int)(10-$count)*15;;
		$color=$this->color;
		eval('$vote.="'.$page->template("modules/voteVote").'";');
		return $vote;
	}

	function showBar () {
		$page=new page;
		$cookie=md5(100000* $this->rnd());
		if (!$_COOKIE["voteID"][$this->id]) setcookie ("voteID[".$this->id."]" , $cookie, time()+60*60*24*90, "/");
		for ($i=$this->grade["min"]; $i<=$this->grade["max"]; $i++) {
			eval('$bar.="'.$page->template("modules/voteTr").'";');
		}
		$color=$this->color;
		eval('$vote.="'.$page->template("modules/voteMain").'";');
		return $vote;
	}

	function checkCookie($cookie) {
		return preg_match("'\w{20}'", $cookie);
	}

	function rnd() {
		list($usec, $sec) = explode(' ', microtime());
		mt_srand((float) $sec + ((float) $usec * 100000));
		return mt_rand();
	}

	function _POST() {
		if ($_POST["vote"]>-1) {
			if ($_POST["id"] && $_SERVER["HTTP_REFERER"]) {
				if ($this->checkCookie($_COOKIE["voteID"][$_POST["id"]])) {
					$this->db->connect();
					$res=$this->db->query("select * from votes where ((IP='".$_SERVER["REMOTE_ADDR"]."' and xIP='".$_SERVER["HTTP_X_FORWARDED_FOR"]."') or cookie='".$_COOKIE["voteID"][$_POST["id"]]."') and id='".$_POST["id"]."'");
					if (!$this->db->num_rows($res)) {
						$this->db->query("insert into votes set IP='".$_SERVER["REMOTE_ADDR"]."', xIP='".$_SERVER["HTTP_X_FORWARDED_FOR"]."', cookie='".$_COOKIE["voteID"][$_POST["id"]]."', id='".$_POST["id"]."', grade='".$_POST["vote"]."', time='".time()."'");
					}
					header("Location: ".$_SERVER["HTTP_REFERER"]);
				}
				else {
					echo "Cookie не включены.<br><a href=\"".$_SERVER["HTTP_REFERER"]."\">Вернуться</a>";
				}
			}
			else {
				header("Location: /");
			}
		}
		else
			header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
}
?>