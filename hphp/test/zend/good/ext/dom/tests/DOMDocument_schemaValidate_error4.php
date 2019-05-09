<?php
<<__EntryPoint>> function main() {
$doc = new DOMDocument;

$doc->load(dirname(__FILE__)."/book.xml");

$result = null;
try { $result = $doc->schemaValidate(); } catch (Exception $e) { echo "\n".'Warning: '.$e->getMessage().' in '.__FILE__.' on line '.__LINE__."\n"; }
var_dump($result);
}
