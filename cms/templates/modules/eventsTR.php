<tr bgcolor="$color">
	<td rowspan="2">$data[id]</td>
	<td rowspan="2">$data[date]</td>
	<td rowspan="2"><b>$data[title]</b></td>
	<td>$data[type_name]</td>
	<td rowspan="2">$data[organizer]</td>
	<td>$data[place]</td>
	<td rowspan="2">$data[text]</td>
	<td style="color: gray;">$data[add_person]</td>
	<td rowspan="2"><a href="/events/?action=edit&id=$data[id]" title="Редактировать"><img src="/i/edit.gif" alt="Р" width="16" height="16" border="0" title="Редактировать"></a>&nbsp; <a href="/events/?action=del&id=$data[id]" title="Удалить"><img src="/i/del.gif" alt="У" width="16" height="16" border="0" title="Удалить"></a></td>
</tr>
<tr bgcolor="$color">
	<td>$data[format_name]</td>
	<td>$data[whereabouts]</td>
	<td>$data[contact_person]</td>
</tr>
