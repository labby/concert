<?php
# php -f µ.php

$a = array();
exec ("zip concert_2\.2\.4\.0.zip *.* */* -r -X -x µ.php", $a);
print_r($a);

?>