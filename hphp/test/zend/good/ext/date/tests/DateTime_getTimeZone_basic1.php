<?hh
/* Prototype  : public DateTimeZone DateTime::getTimezone  ( void  )
 * Description: Return time zone relative to given DateTime
 * Source code: ext/date/php_date.c
 * Alias to functions: date_timezone_get
 */
<<__EntryPoint>> function main(): void {
echo "*** Testing DateTime::getTimezone() : basic functionality ***\n";

date_default_timezone_set("Europe/London");
$object = new DateTime("2009-01-30 17:57:32");
var_dump( $object->getTimezone()->getName() ); 


date_default_timezone_set("America/New_York");
$object = new DateTime("2009-01-30 17:57:32");
var_dump( $object->getTimezone()->getName() ); 

$la_time = new DateTimeZone("America/Los_Angeles");
$object->setTimezone($la_time);
var_dump( $object->getTimezone()->getName() ); 

echo "===DONE===\n";
}
