<?php
<<__EntryPoint>> function main() {
var_dump(parse_url("http://example.com/path/script.html?t=1#fragment?data"));
var_dump(parse_url("http://example.com/path/script.html#fragment?data"));
}
