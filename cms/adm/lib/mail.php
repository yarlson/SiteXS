<?php
function email($to, $from, $subj, $body) {
		mail("$to","$subj","$body","From: $from\nMime-Version: 1.0\nContent-Type: text/plain; charset=\"windows-1251\"\nContent-Transfer-Encoding: 7bit");
}
?>