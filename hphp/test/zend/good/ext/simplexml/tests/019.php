<?php
<<__EntryPoint>> function main() {
$sxe = simplexml_load_string(<<<EOF
<?xml version='1.0'?>
<!DOCTYPE sxe SYSTEM "notfound.dtd">
<sxe id="elem1">
 Plain text.
 <elem1 attr1='first'>
  Bla bla 1.
  <!-- comment -->
  <elem2>
   Here we have some text data.
   <elem3>
    And here some more.
    <elem4>
     Wow once again.
    </elem4>
   </elem3>
  </elem2>
 </elem1>
 <elem11 attr2='second'>
  Bla bla 2.
  <elem111>
   Foo Bar
  </elem111>
 </elem11>
</sxe>
EOF
);

foreach($sxe->children() as $name => $data) {
	var_dump($name);
	var_dump(trim((string)$data));
}

echo "===CLONE===\n";

foreach(clone $sxe->children() as $name => $data) {
	var_dump($name);
	var_dump(trim((string)$data));
}

echo "===ELEMENT===\n";

foreach($sxe->elem11->children() as $name => $data) {
	var_dump($name);
	var_dump(trim((string)$data));
}

echo "===COMMENT===\n";

foreach($sxe->elem1->children() as $name => $data) {
	var_dump($name);
	var_dump(trim((string)$data));
}

echo "===DONE===\n";
}
