<?php
<<__EntryPoint>> function main() {
$subject = 'foo=bar(baz)*';

var_dump(ldap_escape($subject, '', LDAP_ESCAPE_DN | LDAP_ESCAPE_FILTER));
}
