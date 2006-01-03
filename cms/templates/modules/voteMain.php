<form action="/post.php" name="FORMPOST" id="FORMPOST" method="post" style="margin-top: 1em; margin-bottom: 1em;" enctype="application/x-www-form-urlencoded">
<input type="hidden" name="type" value="vote">
<input type="hidden" name="id" value="$this->id">
<table id="vote" cellspacing="0" cellpadding="6">
<tr>
	<td><img src="/i/vote-title-$color.gif" alt="" width="101" height="13" border="0"></td>
	<td><img src="/i/dots.gif" alt="" width="2" height="14" border="0"></td>
	<td>
	<select name="vote">
	<option value="-1">Ваша оценка</option>
$bar
	</select>
	</td>
	<td><input type="image" src="/i/vote-button-$color.gif"></td>
</tr>
</table>
</form>

