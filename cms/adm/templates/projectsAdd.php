<style type="text/css">
input {font-family: tahoma, Times, serif;width: 100%;font-size: 100%;}
textarea {font-family: tahoma, Times, serif;width: 100%;font-size: 100%;line-height: 1.5em;}
</style>
<script language="JavaScript" type="text/javascript">
function showVE(id, field) {
	var w=window.open("ve.php?id="+id+"&f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
</script>
$validator
<h3>$header</h3>
$message
<form action="?chid=$chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input name="fields[id]" size="20" value="$data[id]" type="Hidden">
<p align="center"><input type="button" value="�����" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="���������" style="width: auto;"></p>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="20%">����</th>
	<th width="80%">��������</th>
</tr>
	<tr><td colspan="2"><h3>����� ����������</h3></td></tr>
  <TR> 
    <TD>�</TD> 
    <TD>$data[id]</TD> 
  </TR> 
  <TR> 
    <TD><strong>�������� *</strong></TD> 
    <TD><INPUT class=textfield id="field_1_3" tabIndex=2 maxLength=255 size=40 name="fields[name]" value="$data[name]" title="��������"></TD> 
  </TR> 
  <TR> 
    <TD>�������� �������</TD> 
    <TD><TEXTAREA id="field_2_3"  tabIndex=3 name="fields[description]" rows=7 cols=40>$data[description]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[description]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>������</TD> 
    <TD><TEXTAREA id="field_2_3"  tabIndex=3 name="fields[short]" rows=7 cols=40>$data[short]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[short]');">���������� ��������</a> </TD> 
  </TR>
  <TR> 
    <TD>���������� ���������</TD> 
    <TD>
	<select name="fields[category]">
	<option value="1"$category_selected[1]>A - ������ ����� (��������� ����� �� $3501 �� ���������� ����)</option>
	<option value="2"$category_selected[2]>C - ������-����� (�� $1801 �� $3500 �� �2)</option>
	<option value="3"$category_selected[3]>Y - ������-����� (�� $1800 �� �2)</option>
</select>
  </TR> 
  <TR> 
    <TD><strong>�������� *</strong></TD> 
    <TD><INPUT class=textfield id="field_4_3"  tabIndex=5 maxLength=255 size=40 name="fields[company]" value="$data[company]" title="��������"> </TD> 
  </TR> 
  <TR> 
    <TD>���������� � ��������</TD> 
    <TD><TEXTAREA id="field_5_3"  tabIndex=6 name="fields[company_info]" rows=7 cols=40>$data[company_info]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[company_info]');">���������� ��������</a> </TD> 
  </TR>
  <tr><td colspan="2"><h3>���������� � �������</h3></td></tr> 
  <TR> 
    <TD>����� �������</TD> 
    <TD><INPUT class=textfield id="field_6_3"   tabIndex=7 name="fields[square]" value="$data[square]"> </TD> 
  </TR> 
  <TR> 
    <TD>����� ����, �������������� ���������� �� ������� �����������</TD> 
    <TD><INPUT class=textfield id="field_7_3"   tabIndex=8 maxLength=255 size=40 name="fields[series]" value="$data[series]"> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;����� �������������</h5></td></tr> 
  <TR> 
    <TD>������ �������������</TD> 
    <TD><INPUT class=textfield id="field_8_3"   tabIndex=9 maxLength=99 name="fields[begin]" value="$data[begin]"> </TD> 
  </TR> 
  <TR> 
    <TD>��������� �������������</TD> 
    <TD><INPUT class=textfield id="field_9_3"   tabIndex=10 maxLength=99 name="fields[end]" value="$data[end]"> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;���� (�� 1 ���������� ����)</h5></td></tr>  
  <TR> 
    <TD>����������� ���� �� ��.�. �� ������ ������������� ($)</TD> 
    <TD><INPUT class=textfield id="field_10_3"   tabIndex=11 maxLength=99 name="fields[min_begin]" value="$data[min_begin]"> </TD> 
  </TR> 
  <TR> 
    <TD>������������ ���� ��.�. �� ������ ������������� ($)</TD> 
    <TD><INPUT class=textfield id="field_11_3"   tabIndex=12 maxLength=99 name="fields[max_begin]" value="$data[max_begin]"> </TD> 
  </TR> 
  <TR> 
    <TD>����������� ���� ��.�. �� ������ ������ ($)</TD> 
    <TD><INPUT class=textfield id="field_12_3"   tabIndex=13 maxLength=99 name="fields[min_current]" value="$data[min_current]"> </TD> 
  </TR> 
  <TR> 
    <TD>������������ ���� ��.�. �� ������ ������ ($)</TD> 
    <TD><INPUT class=textfield id="field_13_3"   tabIndex=14 maxLength=99 name="fields[max_current]" value="$data[max_current]"> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;�����������������</h5>
  <TEXTAREA id="field_14_3"  tabIndex=15 name="fields[place]" rows=7 cols=40>$data[place]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[place]');">���������� ��������</a> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;���������� � ��������, ����� � ����������� �������</h5><TEXTAREA id="field_15_3"  tabIndex=16 name="fields[square_info]" rows=7 cols=40>$data[square_info]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[square_info]');">���������� ��������</a> </TD> 
  </TR> 
  <tr><td colspan="2"><h5>&nbsp;&nbsp;����������� ��������������</h5></td></tr>  
  <TR> 
    <TD>�������� ����</TD> 
    <TD><TEXTAREA id="field_16_3"  tabIndex=17 name="fields[materials]" rows=7 cols=40>$data[materials]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[materials]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>������ ��������</TD> 
    <TD><INPUT class=textfield id="field_17_3" tabIndex=18 maxLength=99 name="fields[height]" value="$data[height]"> </TD> 
  </TR> 
  <TR> 
    <TD>������������ (��������� ������������)</TD> 
    <TD><TEXTAREA id="field_18_3"  tabIndex=19 name="fields[communications]" rows=7 cols=40>$data[communications]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[communications]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>������������ (���������)</TD> 
    <TD><TEXTAREA id="field_18_3"  tabIndex=20 name="fields[glass]" rows=7 cols=40>$data[glass]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[glass]');">���������� ��������</a></TD> 
  </TR> 
  <TR> 
    <TD>�������� ������������ (���������)</TD> 
    <TD><TEXTAREA id="field_18_3"  tabIndex=21 name="fields[elevator]" rows=7 cols=40>$data[elevator]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[elevator]');">���������� ��������</a></TD> 
  </TR> 
  <TR> 
    <TD>IT-������������</TD> 
    <TD><TEXTAREA id="field_21_3"  tabIndex=22 name="fields[it]" rows=7 cols=40>$data[it]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[it]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>������� (���������)</TD> 
    <TD><TEXTAREA id="field_21_3"  tabIndex=23 name="fields[battery]" rows=7 cols=40>$data[battery]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[battery]');">���������� ��������</a></TD> 
  </TR> 
	<tr><td colspan="2"><h5>&nbsp;&nbsp;���������� � ���������, � ������� �������� ��������������� ����������� </h5><TEXTAREA id="field_23_3"  tabIndex=24 name="fields[state_info]" rows=7 cols=40>$data[state_info]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[state_info]');">���������� ��������</a> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;�������</h5></td></tr> 
  <TR> 
    <TD>������� ��������, �����������.</TD> 
    <TD><INPUT class=textfield id="field_24_3" tabIndex=25 maxLength=99 name="fields[parking]" value="$data[parking]"> </TD> 
  </TR> 
  <TR> 
    <TD>����������</TD> 
    <TD><INPUT class=textfield id="field_25_3" tabIndex=26 maxLength=99 name="fields[parking_count]" value="$data[parking_count]"> </TD> 
  </TR> 
  <TR> 
    <TD>��������� �����������</TD> 
    <TD><INPUT class=textfield id="field_26_3"   tabIndex=27 maxLength=99 name="fields[parking_price]" value="$data[parking_price]"> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;������ ���������</h5></td></tr>
  <TR> 
    <TD>������� ������� ���������</TD> 
    <TD><INPUT class=textfield id="field_27_3" tabIndex=28 maxLength=99 name="fields[store_square]" value="$data[store_square]"> </TD> 
  </TR> 
  <TR> 
    <TD>������� ��������� ������ ����������</TD> 
    <TD><INPUT class=textfield id="field_28_3" tabIndex=29 maxLength=99 name="fields[common_square]" value="$data[common_square]"> </TD> 
  </TR> 
  <tr><td colspan="2"><h5>&nbsp;&nbsp;�������� �������������� ����, �� �������, ��������� �����</h5>
  <TEXTAREA id="field_29_3"  tabIndex=30 name="fields[infrastructure_info]" rows=7 cols=40>$data[infrastructure_info]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[infrastructure_info]');">���������� ��������</a> </TD> 
  </TR> 
  <tr><td colspan="2"><h5>&nbsp;&nbsp;������� ������, ���������, ��������</h5><INPUT class=textfield id="field_30_3" tabIndex=31 maxLength=255 size=40 name="fields[guard]" value="$data[guard]"> </TD> 
  </TR> 
<tr><td colspan="2"><h5>&nbsp;&nbsp;������� ������� ����������� � ������</h5><TEXTAREA id="field_31_3"  tabIndex=32 name="fields[common_decoration]" rows=7 cols=40>$data[common_decoration]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[common_decoration]');">���������� ��������</a> </TD> 
  </TR> 
<tr><td colspan="2"><h5>&nbsp;&nbsp;����������� �������� ���� (��������, ����������)</h5><TEXTAREA id="field_21_3"  tabIndex=33 name="fields[managing_company]" rows=7 cols=40>$data[managing_company]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[managing_company]');">���������� ��������</a></TD> 
  </TR> 
  <TR> 
    <TD>��������� ������������ �����</TD> 
    <TD><INPUT class=textfield id="field_33_3" tabIndex=34 maxLength=99  name="fields[utilities_cost]" value="$data[utilities_cost]"> </TD> 
  </TR> 
   <tr><td colspan="2"><h5>&nbsp;&nbsp;���������� � ��������������� ��������� ����������</h5><TEXTAREA id="field_39_3"  tabIndex=37 name="fields[accomplishment]" rows=7 cols=40>$data[accomplishment]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[accomplishment]');">���������� ��������</a> </TD> 
  </TR> 
  <tr><td colspan="2"><h3>����������</h3></td></tr>
  <TR> 
    <TD>����� ����� �������� � ���������</TD> 
    <TD><INPUT class=textfield id="field_34_3"   tabIndex=35 maxLength=255 company_site size=40 name="fields[company_site]" value="$data[company_site]"> </TD> 
  </TR> 
   <TR> 
    <TD>������� ��������</TD> 
    <TD><TEXTAREA id="field_5_3"  tabIndex=6 name="fields[company_logo]" rows=7 cols=40>$data[company_logo]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[company_logo]');">���������� ��������</a> </TD> 
  </TR>
  <TR> 
    <TD>����� ����� ������� � ���������</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[project_site]" value="$data[project_site]"> </TD> 
  </TR>
  <TR> 
    <TD>������� �������</TD> 
    <TD><TEXTAREA id="field_2_3"  tabIndex=3 name="fields[project_logo]" rows=7 cols=40>$data[project_logo]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[project_logo]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>���������� �������</TD> 
    <TD><TEXTAREA id="field_36_3"  tabIndex=37 name="fields[plan_pic]" rows=7 cols=40>$data[plan_pic]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[plan_pic]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>����������� ����������� �������</TD> 
    <TD><TEXTAREA id="field_37_3"  tabIndex=38 name="fields[object_pic]" rows=7 cols=40>$data[object_pic]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[object_pic]');">���������� ��������</a> </TD> 
  </TR> 
  <TR> 
    <TD>������������ ���������� ���� �� ��������� � ����������</TD> 
    <TD><TEXTAREA id="field_38_3"  tabIndex=39 name="fields[comp_pic]" rows=7 cols=40>$data[comp_pic]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[comp_pic]');">���������� ��������</a> </TD> 
  </TR>
  <tr><td colspan="2"><h5>&nbsp;&nbsp;���������� ����������</h5></td></tr>  
  <TR> 
    <TD>�������, ���, ��������</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[fio]" value="$data[fio]"> </TD> 
  </TR>
  <TR> 
    <TD>���������</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[jobtitle]" value="$data[jobtitle]"> </TD> 
  </TR>
  <TR> 
    <TD>�������</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[phone]" value="$data[phone]"> </TD> 
  </TR>
  <TR> 
    <TD>����������� �����</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[email]" value="$data[email]"> </TD> 
  </TR> 
  <TR> 
    <TD>���� ������ ������<br>(��.��.����)</TD> 
    <TD><INPUT class=textfield id="field_35_3"   tabIndex=36 maxLength=255 size=40 name="fields[date]" value="$data[date]"> </TD> 
  </TR>
  <TR> 
    <TD>�������� � ������������</TD> 
    <TD><TEXTAREA id="field_38_3"  tabIndex=41 name="fields[photos]" rows=10 cols=40>$data[photos]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[photos]');">���������� ��������</a> </TD> 
  </TR>
  <TR> 
    <TD>�������� � ������������</TD> 
    <TD><TEXTAREA id="field_38_3"  tabIndex=42 name="fields[plans]" rows=10 cols=40>$data[plans]</TEXTAREA><br><a href="#" onClick="return showVE('$data[id]', 'fields[plans]');">���������� ��������</a> </TD> 
  </TR> 
</TABLE> 
	
<p><b>*&nbsp;&mdash; ������������ ����</b></p>
<p align="center"><input type="button" value="�����" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="���������" style="width: auto;"></p>
</form>