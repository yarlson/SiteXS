<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>$config[site_name] - $elements[title]</title>
	<link href="/style.css" rel="stylesheet" type="text/css">
	<meta name="description" content="$elements[desription]">
	<meta name="keywords" content="$elements[keywords]">
	<script language="JavaScript" type="text/javascript">
		function popup(url, width, height) {
			width=width.parseint + 32;
			height=height.parseint+32;
			window.open(url, "", "width=" + width + ",height="+height+32+",location=no,menubar=no,status=no,toolbar=no,resizable=yes,top=0,left=0,scrollbars=yes");
			return false;
		}
	</script>
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0" id="outer" border="0">
<tr>
	<td colspan="3" class="line"><img src="/ii/dot.gif" alt="" width="1" height="3" border="0"></td>
</tr>
<tr id="head">
	<td align="right" width="30%" valign="top">
		<table cellspacing="0" cellpadding="0" width="100%" id="l">
		<tr>
			<td rowspan="2" id="l1" width="100%"><div><img src="/ii/dot.gif" alt="" width="1" height="153" border="0"></div></td>
			<td rowspan="2"><a href="http://www.m-2.ru" target="_blank"><img src="/ii/m2.jpg" alt="М2 = КВАДРАТНЫЙ МЕТР" width="141" height="153" border="0" title="М2 = КВАДРАТНЫЙ МЕТР"></a></td>
			<td id="l2">Газета о недвижимости<br>М2 = КВАДРАТНЫЙ МЕТР. Вся информация для принятия решения на московском рынке жилья.</td>
		</tr>
		<tr>
			<td id="l3" valign="bottom"><img src="/ii/news.jpg" alt="" width="144" height="53" border="0" title=""></td>
		</tr>
		</table>
	</td>
	<td id="m1" width="45%" valign="top">
		<table cellpadding="0" cellspacing="0" width="100%" border="0">
		<tr>
			<td valign="top">$a_b<img src="/ii/nd.jpg" alt="М2.НОВЫЙ ДОМ 2004" width="200" height="153" border="0" title="$a_t">$a_e</td>
			<td id="m2" width="100%" valign="top">
				<table cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td><img src="/ii/dot.gif" alt="" width="1" height="133" border="0"></td>
					<td width="100%" valign="top" style="padding: 0;height: 100%;">
						<table width="100%" cellspacing="0" cellpadding="0" style="height: 100%;">
						<tr>
							<td><div>Ведущие строительные компании и девелоперы жилой недвижимости Москвы представляют: лучшие строительные проекты года на конкурсе М2. Новый дом - 2004</div></td>
						</tr>
						<tr style="height: 100%;">
							<td align="right" style="padding-bottom: 10px;" valign="bottom" style="height: 100%;"><a href="/about/">>> Подробнее о конкурсе</a></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
	<td width="25%" valign="top">
		<table cellspacing="0" cellpadding="0" id="r">
		<tr>
			<td><a href="/winners/"><img src="/ii/btn-w.jpg" alt="" border="0"></a></td>
			<td id="r1" width="100%"></td>
		</tr>
		<tr>
			<td id="r21"><a href="/conditions/"><img src="/ii/btn-c.jpg" alt="" border="0"></a></td>
			<td id="r22"></td>
		</tr>
		<tr>
			<td><a href="/projects/"><img src="/ii/btn-l.jpg" alt="" border="0"></a></td>
			<td id="r22"></td>
		</tr>
		<tr>
			<td id="r23"><a href="/jury/"><img src="/ii/btn-j.jpg" alt="" border="0"></a></td>
			<td id="r22"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="3" class="line"><img src="/ii/dot.gif" alt="" width="1" height="4" border="0"></td>
</tr>
<tr style="height: 100%;">
$elements[news]
	<td id="content" valign="top" style="height: 100%;"$colspan>
			
		$elements[breadCrumbs]
$elements[contentTitle]
$elements[content]
	<!--begin of Rambler's Top100 code -->
<a href="http://top100.rambler.ru/top100/">
<img src="http://counter.rambler.ru/top100.cnt?206897" alt="" width=1 height=1 border=0></a>
<!--end of Top100 code-->
	</td>
	<td id="rbar" valign="top" style="padding-top: 18px;">
	<p align="center">
	$config[genpartner]
	$config[info_sonsor]</p>
	$elements[news1]</td>
</tr>
<tr id="footer">
	<td valign="top" id="copyright">
Copyright &copy; $year <a href="http://www.m-2.ru/">M2</a><br>
М2 = Квадратный метр – газета<br>
о недвижимости Москвы и Подмосковья

	</td>
	<td colspan="2" align="center" valign="top">
		<table cellpadding="10">
		<tr>
			<td><a href="/news/">Новости</a></td>
			<td><a href="/request/">Подать заявку</a></td>
			<td><a href="/conditions/">Условия конкурса</a></td>
			<td><a href="/projects/">Список участников</a></td>
			<td><a href="/jury/">Жюри</a></td>
		</tr>
		<tr>
			<td colspan="4" align="right">
<!--begin of Top100 logo-->
<a href="http://top100.rambler.ru/top100/">
<img src="http://top100-images.rambler.ru/top100/banner-88x31-rambler-darkblue2.gif" alt="Rambler's Top100" width=88 height=31 border=0></a>
<!--end of Top100 logo -->
			</td>
		</tr>
		</table>

	</td>
</tr>
</table>

</body>
</html>
