<?php

/* Lapvédelem */
session_start();
if (!isset($_SESSION['belepett'])) {
    header("Location: index.php");
}

/* Admin törtlése */
if (isset($_GET['torles'])) {
}
/* Admin létrehozása */

/* Admin listázása */
require_once("../adatbazis.php");

$sql    =   "SELECT id, email, letrehozas
            FROM cms_admin
            ORDER BY id ASC";


$eredmeny   =       mysqli_query($dbconn, $sql);


$tablazat   =  "<p><a href=\"admin-kezeles.php?letrehozas\"><span class=\"material-symbols-outlined\">add_box</span>Új admin hozzáadása</a></p>";

$tablazat  .= "<table>\n";

$tablazat .= "<tr>
                <th>ID</th>
                <th>E-mail</th>
                <th>Létrehozás</th>
                <th>Művelet</th>
            </tr>\n";

while ($sor = mysqli_fetch_assoc($eredmeny)) {
    $tablazat .= "<tr>
                    <td>{$sor['id']}</td>
                    <td>{$sor['email']}</td>
                    <td>{$sor['letrehozas']}</td>
                    <td><a href=\"admin-kezeles.php?torles={$sor['id']}\"><span class=\"material-symbols-outlined\" onclick=\"return confirm('Biztos benne?')\">delete</span></a></td>       
                </tr>\n";
}

$tablazat  .= "</table>\n";

$menu   =   "<ul>
                <li><a href=\"kilepes.php\">Kilépés</a></li>
                <li></li>
            </ul>";


/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{menu}}",           $menu,                 $sablon);
$sablon = str_replace("{{menunev}}",        "Szerkesztes",      $sablon);
$sablon = str_replace("{{tartalom}}",       $tablazat,          $sablon);
$sablon = str_replace("{{oldalsav}}",         "",               $sablon);

print $sablon;
