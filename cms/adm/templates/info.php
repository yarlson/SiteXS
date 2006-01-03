<div id="cins">
<h3 style="padding-left: 0px;"><img src="i/i.gif" alt="" width="32" height="32" hspace="10" border="0" align="absmiddle"><? echo __("Info") ?></h3>
<ul id="info">
<li><? echo __("Site URL") ?>: <strong><a href="http://<?php echo $_SERVER["SERVER_NAME"] ?>">http://<?php echo $_SERVER["SERVER_NAME"] ?></a></strong></li>
<li><?php echo __("Site IP") ?>: <strong><?php echo $_SERVER["SERVER_ADDR"] ?></strong></li>
<li><?php echo __("Web-server") ?>: <strong><?php echo $_SERVER["SERVER_SOFTWARE"] ?></strong></li>
<li><?php echo __("OS") ?>: <strong><?php echo PHP_OS ?></strong></li>
<li><?php echo __("PHP version") ?>: <strong><?php echo PHP_VERSION ?></strong></li>
<li><?php echo __("MySQL version") ?>: <strong><?php echo $ref->MYSQL_VER ?></strong></li>
<li><?php echo __("CMS version") ?>: <strong><?php echo $ref->CMS ?></strong></li>
<li><?php echo __("Author") ?>: <strong><a href="$HOME_PAGE" target="_blank"><?php echo $ref->AUTHOR ?></a></strong></li>
</ul>
</div>