<?php
$dbhost = 'ORCL';
$dbuser = 'DAWERPJ';
$dbpass = 'dawer123';

$conn = oci_connect($dbuser, $dbpass, $dbhost ) or die    ('Error connecting to mysql');

?>