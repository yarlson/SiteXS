<?php
//args =>	pid, title, class name, icon name, admin
$nav[1]=array(0, __("Content"), "content", "content.gif");

$nav[2]=array(1, __("Structure"), "item", "struct.gif");
$nav[3]=array(1, __("Images"), "images", "images.gif");
$nav[4]=array(1, __("Files"), "files", "files.gif");

$nav[5]=array(0, __("Modules"), "modules", "modules.gif");

$nav[6]=array(5, __("News"), "news", "news.gif");
$nav[7]=array(5, __("Subsription"), "subscribe", "subscribe.gif");

$nav[8]=array(0, __("Params"), "conf", "options.gif", 1);

$nav[9]=array(0, __("Users"), "users", "users.gif", 1);


$admin_config["show_warnings"]=true;
$admin_config["adm_root"]="adm";
$admin_config["name"]="SiteXS";
$admin_config["version"]="Pre-Alpha";
$admin_config["author"]="Yar Kravtsov";
$admin_config["home_page"]="http://yarlson.net.ru/";

$admin_config["recPerPage"]=20;

?>