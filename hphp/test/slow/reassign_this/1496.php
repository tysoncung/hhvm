<?php
<<__EntryPoint>> function main() {
$myarray = array(1 => 2, 2 => 3);
 foreach ($myarray as $a => $this) {
  echo "You should not see this";
 }
}
