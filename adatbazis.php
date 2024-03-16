<?php
//error_reporting(E_ALL);/* milyen szintu hibakat akarok megjeleniteni , ez minden hibat jelent*/
//ini_set("display_errors", 1);/* futtasidoben kiirja az error-t */
$dbconn         =   @mysqli_connect("localhost", "root", "", "php_a_gyakorlatban");

@mysqli_query($dbconn, "SET NAMES utf8"); 