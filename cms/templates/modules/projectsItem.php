$voteBar
<table cellspacing="6" cellpadding="0" width="100%" class="toptable">
<tr>
	<td width="100%"$hide_class>
<table width="100%" cellpadding="6" cellspacing="6">
<tr>
$photos_html
</tr>
</table>
	</td>
	<td style="padding: 3px;width: 150px;">
	<p><img src="/i/dot.gif" alt="" width="150" height="1" border="0"></p>
	$photos_link
	$plans_link
	$map_link
	<p><img src="/i/dot.gif" alt="" width="150" height="1" border="0"></p>
	</td>
</tr>
</table>

<p>$data[description]</p>
<br>
<table width="100%">
<tr>
	<td><h4 style="margin: 0px;">��������-���������: $data[company]</h4></td>
	<td align="right">$a_b$data[company_logo]$a_e</td>
</tr>
</table>

<div style="border: 1px solid silver; padding: 1em;font-size: 0.9em;">
$data[company_info]
</div>
<h4>���������� � �������</h4>
<p>����� �������: $data[square]</p>
<p>$data[series]</p>
<p>������ �������������: $data[begin]<br>
��������� �������������: $data[end]
</p>
<h4>���� (�� 1 ���������� ����)</h4>
<table cellspacing="0" class="border">
<tr>
	<th>����������� �� ������ �������������</th>
	<td>$data[min_begin]</td>
</tr>
<tr>
	<th>������������ ������ �������������</th>
	<td>$data[max_begin]</td>
</tr>
<tr>
	<th>����������� �� ������ ������</th>
	<td>$data[min_current]</td>
</tr>
<tr>
	<th>������������ �� ������ ������</th>
	<td>$data[max_current]</td>
</tr>
</table>

<h4>�����������������</h4>
<p>$data[place]</p>
<h4>����������</h4>
<p>$data[square_info]</p>
<h4>����������� ��������������</h4>
<table class="border" cellspacing="0">
<tr>
	<th>�������� ����</th>
	<td>$data[materials]</td>
</tr>
<tr>
	<th>������ ��������</th>
	<td>$data[height] �</td>
</tr>
<tr>
	<th>������������</th>
	<td>$data[communications]</td>
</tr>
<tr>
	<th>������������</th>
	<td>$data[glass]</td>
</tr>
<tr>
	<th>�������� ������������</th>
	<td>$data[elevator]</td>
</tr>
<tr>
	<th>IT-������������</th>
	<td>$data[it]</td>
</tr>
<tr>
	<th>�������</th>
	<td>$data[battery]</td>
</tr>
</table>
<h4>���������� � ���������, � ������� �������� ��������������� �����������</h4>
<p>$data[state_info]</p>
<h4>�������</h4>
<p>������� ��������, �����������: $data[parking]<br>
����������: $data[parking_count]<br>
��������� �����������: $data[parking_price]<br></p>
<h4>������ ���������</h4>
<p>������� ������� ���������: $data[store_square]<br>
������� ��������� ������ ����������: $data[common_square]</p>
<h4>�������� �������������� ����, �� �������, ��������� �����</h4>
<p>$data[infrastructure_info]</p>
<table cellspacing="0" class="border">
<tr>
	<th>������� ������, ���������, ��������</th>
	<td>$data[guard]</td>
</tr>
<tr>
	<th>������� ������� ����������� � ������</th>
	<td>$data[common_decoration]</td>
</tr>
<tr>
	<th>����������� �������� ����</th>
	<td>$data[managing_company]</td>
</tr>
<tr>
	<th>��������� ������������ �����</th>
	<td>$data[utilities_cost]</td>
</tr>
<tr>
	<th>���������� � ��������������� ��������� ����������</th>
	<td>$data[accomplishment]</td>
</tr>
</table>
$voteBar