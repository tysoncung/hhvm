<?php
<<__EntryPoint>> function main() {
$a = array('zero' => 0, 'one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5);
//foreach (new ArrayIterator($a) as $k => $v)
foreach (new LimitIterator(new ArrayIterator($a), 1, 3) as $k => $v)
{
	var_dump(array($k, $v));
}

echo "===DONE===\n";
}
