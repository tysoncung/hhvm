<?php
<<__EntryPoint>> function main() {
$ok = 1;
$doc = simplexml_load_string('<root><exists>foo</exists></root>');
if(!isset($doc->exists)) {
	$ok *= 0;
}
if(isset($doc->doesnotexist)) {
	$ok *= 0;
}
if ($ok) {
         print "Works\n";
} else {
         print "Error\n";
}
echo "===DONE===\n";
}
