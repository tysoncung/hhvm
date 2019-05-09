<?php
<<__EntryPoint>> function main() {
$name = tempnam('/tmp', 'readline.tmp');

readline_add_history('foo');
readline_add_history('');
readline_add_history(1);
readline_add_history(NULL);
var_dump(readline_write_history($name));
var_dump(readline_read_history($name));

var_dump(file_get_contents($name));

readline_clear_history();
readline_write_history($name);
var_dump(file_get_contents($name));

unlink($name);
}
