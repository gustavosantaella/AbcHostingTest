<?php

$comando = 'mysql -u root -p "" abchosting < database.SQL';

$ultima_linea = system($comando, $retornoCompleto);

print_r( $ultima_linea );
print_r( $retornoCompleto );


?>