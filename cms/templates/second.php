<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?php echo $ref->config["site_name"]." - ".$ref->elements["title"] ?></title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<meta name="description" content="<?php echo $ref->elements["description"] ?>">
	<meta name="keywords" content="<?php echo $ref->elements["keywords"] ?>">
    <meta http-equiv="content-type" content="text/html; charset=<?php echo $ref->config["charset"] ?>"> 
</head>

<body>
<div><?php echo $ref->elements["breadCrumbs"] ?></div>
<h2><?php echo $ref->elements["contentTitle"] ?></h2>
<?php echo $ref->elements["content"] ?>
</body>
</html>
