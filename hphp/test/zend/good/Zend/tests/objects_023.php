<?php 
<<__EntryPoint>> function main() {
$arr = array(new stdClass, 'stdClass');

new $arr[0]();
new $arr[1]();

print "ok\n";
}
