<?php
<<__EntryPoint>> function main() {
$im = imagecreatetruecolor(5,5);
$c = imagecolorclosest($im, 255,0,255);
printf("%X\n", $c);
imagedestroy($im);

$im = imagecreate(5,5);
$c = imagecolorclosest($im, 255,0,255);
print_r(imagecolorsforindex($im, $c));
imagedestroy($im);

$im = imagecreate(5,5);
imagecolorallocate($im, 255, 0, 255);
$c = imagecolorclosest($im, 255,0,255);
print_r(imagecolorsforindex($im, $c));
imagedestroy($im);

$im = imagecreate(5,5);
for ($i=0; $i<255; $i++) imagecolorresolve($im, $i,0,0);
$c = imagecolorclosest($im, 255,0,0);
print_r(imagecolorsforindex($im, $c));


$im = imagecreate(5,5);
for ($i=0; $i<256; $i++) {
	if ($i == 246) {
		imagecolorallocate($im, $i,10,10);
	} else {
		imagecolorallocate($im, $i,0,0);
	}
}
$c = imagecolorclosest($im, 255,10,10);
print_r(imagecolorsforindex($im, $c));

// with alpha
$im = imagecreatetruecolor(5,5);
$c = imagecolorclosestalpha($im, 255,0,255,100);
printf("%X\n", $c);
imagedestroy($im);

$im = imagecreate(5,5);
$c = imagecolorclosestalpha($im, 255,0,255,100);
print_r(imagecolorsforindex($im, $c));
imagedestroy($im);

$im = imagecreate(5,5);
imagecolorallocatealpha($im, 255, 0, 255, 1);
$c = imagecolorclosestalpha($im, 255,0,255,1);
print_r(imagecolorsforindex($im, $c));
imagedestroy($im);

$im = imagecreate(5,5);
for ($i=0; $i<255; $i++) imagecolorresolvealpha($im, $i,0,0,1);
$c = imagecolorclosestalpha($im, 255,0,0,1);
print_r(imagecolorsforindex($im, $c));


$im = imagecreate(5,5);
for ($i=0; $i<256; $i++) {
	if ($i == 246) {
		imagecolorallocatealpha($im, $i,10,10,1);
	} else {
		imagecolorallocatealpha($im, $i,0,0,100);
	}
}
$c = imagecolorclosestalpha($im, 255,10,10,1);
print_r(imagecolorsforindex($im, $c));
}
