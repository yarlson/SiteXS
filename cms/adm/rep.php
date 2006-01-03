<?php
$dir="./templates";
if ($handle = opendir($dir)) {
    while (false !== ($file = readdir($handle))) { 
        if (preg_match('/\.php$/', $file)) {
            $f=fopen("$dir/$file", "r");
            
            $contents = fread($f, filesize("$dir/$file"));
            $contents1 = rep($contents);
            if ($contents1<>$contents) {
                $f1=fopen(str_replace(".php", "_.php", "$dir/$file"), "w+");
                fwrite($f1,$contents1);
            }
        }
    }
}


function rep($input) {
    preg_match_all('/([\w\-]*[\x80-\xFF]+[\w\-]*(\s+[\w\-]*[\x80-\xFF]+[\w\-]*)*)\s*/is', $input, $matches);
    foreach ($matches[1] as $value) {
        $input = str_replace($value, "<?php __(\"".$value.'") ?>', $input);
        $input = str_replace('__("<?php __("', '__("', $input);
        $input = str_replace('") ?>") ?>', '") ?>', $input);
    }
    return $input;
}
?>