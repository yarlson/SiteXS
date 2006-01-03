$validator
<h2 align="center">$header</h2>
<form action="/post.php" method="post" name="FORMPOST">
<input type="hidden" name="action" value="$action"><input type="hidden" name="type" value="events">
<INPUT type="Hidden" name="fields[id]" value="$data[id]" size="20" maxlength="99">
<p align="center"><input type="button" value="Назад" onclick="javascript: window.location='$_SESSION[HTTP_REFERER]'">&nbsp;&nbsp;<input type="submit" value="Сохранить"></p>
	<p align="center">
	<TABLE border="0" id="events" cellspacing="0" cellpadding="5">
		<TR bgcolor="#F0F0F0">
			<TH>Поле</TH>
			<TH>Значение</TH>
		</TR>
		<TR>
			<TD>№</TD>
			<TD><INPUT type="text" name="id" value="$data[id]" size="20" maxlength="99" tabindex="1" disabled></TD>
		</TR>
		<TR bgcolor="#F0F0F0">
			<TD>Дата</TD>
			<TD><INPUT type="text" name="fields[time]" value="$data[date]" size="20" maxlength="99" tabindex="2">&nbsp;&minus; <INPUT type="text" name="fields[time_end]" value="$data[date_end]" size="20" maxlength="99" tabindex="3"></TD>
		</TR>
		<TR>
			<TD>Заголовок</TD>
			<TD><INPUT type="text" name="fields[title]" value="$data[title]" size="40" maxlength="255" tabindex="4"></TD>
		</TR>
		<TR bgcolor="#F0F0F0">
			<TD>Формат участия М2</TD>
			<TD>
<select name="fields[format]" tabindex="5">
<option value=""></option>
$select_format
</select>
		</TR>
		<TR>
			<TD>Тип</TD>
			<TD>
<select name="fields[type]" tabindex="6">
<option value=""></option>
$select_type
</select>
			</TD>
		</TR>
		<TR bgcolor="#F0F0F0">
			<TD>Организатор</TD>
			<TD><INPUT type="text" name="fields[organizer]" value="$data[organizer]" size="40" maxlength="255" tabindex="7"></TD>
		</TR>
		<TR>
			<TD>Место проведения</TD>
			<TD>
				<TEXTAREA name="fields[place]" rows="7" cols="40" tabindex="8">$data[place]</TEXTAREA></TD>
		</TR>
		<TR bgcolor="#F0F0F0">
			<TD>Координаты</TD>
			<TD><TEXTAREA name="fields[whereabouts]" rows="7" cols="40" tabindex="9">$data[whereabouts]</TEXTAREA></TD>
		</TR>
		<TR>
			<TD>Примечание</TD>
			<TD>
				<TEXTAREA name="fields[text]" rows="7" cols="40" tabindex="10">$data[text]</TEXTAREA></TD>
		</TR>
		<TR bgcolor="#F0F0F0">
			<TD>Событие добавил</TD>
			<TD><INPUT type="text" name="fields[add_person]" value="$data[add_person]" size="40" maxlength="255" tabindex="11"></TD>
		</TR>
		<TR>
			<TD>Идет</TD>
			<TD><INPUT type="text" name="fields[contact_person]" value="$data[contact_person]" size="40" maxlength="255" tabindex="12"></TD>
		</TR>
	</TABLE></p>
	<p align="center"><input type="button" value="Назад" onclick="javascript: window.location='$_SESSION[HTTP_REFERER]'">&nbsp;&nbsp;<input type="submit" value="Сохранить"></p>
</form>