<?php
<<__EntryPoint>> function main() {
$im = imagecreate(10, 10);

$tmp = imagerotate ($im, 5.0, -9999999);

var_dump($tmp);

if ($tmp) {
        imagedestroy($tmp);
}

if ($im) {
        imagedestroy($im);
}
}
