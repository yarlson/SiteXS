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
	<td><h4 style="margin: 0px;">Компания-заявитель: $data[company]</h4></td>
	<td align="right">$a_b$data[company_logo]$a_e</td>
</tr>
</table>

<div style="border: 1px solid silver; padding: 1em;font-size: 0.9em;">
$data[company_info]
</div>
<h4>Информация о проекте</h4>
<p>Общая площадь: $data[square]</p>
<p>$data[series]</p>
<p>Начало строительства: $data[begin]<br>
Окончание строительства: $data[end]
</p>
<h4>Цены (за 1 квадратный метр)</h4>
<table cellspacing="0" class="border">
<tr>
	<th>Минимальная на начало строительства</th>
	<td>$data[min_begin]</td>
</tr>
<tr>
	<th>Максимальная начало строительства</th>
	<td>$data[max_begin]</td>
</tr>
<tr>
	<th>Минимальная на данный момент</th>
	<td>$data[min_current]</td>
</tr>
<tr>
	<th>Максимальная на данный момент</th>
	<td>$data[max_current]</td>
</tr>
</table>

<h4>Месторасположение</h4>
<p>$data[place]</p>
<h4>Планировки</h4>
<p>$data[square_info]</p>
<h4>Технические характеристики</h4>
<table class="border" cellspacing="0">
<tr>
	<th>Материал стен</th>
	<td>$data[materials]</td>
</tr>
<tr>
	<th>Высота потолков</th>
	<td>$data[height] м</td>
</tr>
<tr>
	<th>Коммуникации</th>
	<td>$data[communications]</td>
</tr>
<tr>
	<th>Стеклопакеты</th>
	<td>$data[glass]</td>
</tr>
<tr>
	<th>Лифтовое оборудование</th>
	<td>$data[elevator]</td>
</tr>
<tr>
	<th>IT-коммуникации</th>
	<td>$data[it]</td>
</tr>
<tr>
	<th>Батареи</th>
	<td>$data[battery]</td>
</tr>
</table>
<h4>Информация о состоянии, в котором квартиры предоставляются получателям</h4>
<p>$data[state_info]</p>
<h4>Паркинг</h4>
<p>Наличие паркинга, машиноместа: $data[parking]<br>
Количество: $data[parking_count]<br>
Стоимость машиноместа: $data[parking_price]<br></p>
<h4>Другие помещения</h4>
<p>Площадь нежилых помещений: $data[store_square]<br>
Площадь помещений общего назначения: $data[common_square]</p>
<h4>Описание инфраструктуры дома, ее площадь, стоимость услуг</h4>
<p>$data[infrastructure_info]</p>
<table cellspacing="0" class="border">
<tr>
	<th>Наличие охраны, консьержа, домофона</th>
	<td>$data[guard]</td>
</tr>
<tr>
	<th>Отделка входных пространств и холлов</th>
	<td>$data[common_decoration]</td>
</tr>
<tr>
	<th>Управляющая компания дома</th>
	<td>$data[managing_company]</td>
</tr>
<tr>
	<th>Стоимость коммунальных услуг</th>
	<td>$data[utilities_cost]</td>
</tr>
<tr>
	<th>Информация о благоустройстве имеющейся территории</th>
	<td>$data[accomplishment]</td>
</tr>
</table>
$voteBar