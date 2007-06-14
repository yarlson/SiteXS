<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $ref->config["site_name"] ?></title>

<meta name="generator" content="SiteXS" />

<link rel="stylesheet" href="/templates/test-style.css" type="text/css" media="screen" />

</head>
<body>
<div id="page">


<div id="header">
	<div id="headerimg">
		<h1><a href="/"><?php echo $ref->config["site_name"] ?></a></h1>
		<div class="description"></div>

	</div>
</div>
<hr />
	<div id="content" class="narrowcolumn">
<div><?php echo $ref->elements["breadcrumbs"] ?></div>
<?php echo $ref->elements["contenttitle"] ?>
<?php echo $ref->elements["content"] ?>
	</div>
	<div id="sidebar">
<ul>
<li>
<?php $menu=$ref->elements["menus"]; echo $menu[1]; ?>
</li>
</ul>
	</div>



<hr />
<div id="footer">
<!-- If you'd like to support WordPress, having the "powered by" link somewhere on your blog is the best way, it's our only promotion or advertising. -->
	<p>
		<?php echo $ref->config["site_name"] ?> is proudly powered by
		<a href="http://sitexs.sf.net/">SiteXS CMS</a>
		<br /><a href="http://www.yarlson.com/index.php/feed/">Entries (RSS)</a>
		and <a href="http://www.yarlson.com/index.php/comments/feed/">Comments (RSS)</a>.
		<!-- 20 queries. 0.529 seconds. -->

	</p>
</div>
</div>

<!-- Gorgeous design by Michael Heilemann - http://binarybonsai.com/kubrick/ -->
</body>
</html>
