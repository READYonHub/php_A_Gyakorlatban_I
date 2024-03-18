<?php

/* Lapvédelem */
session_start();
if (!isset($_SESSION['belepett'])) {
    header("Location: index.php");
}

require_once("../adatbazis.php");

$sql        =       "SELECT id, allias, sorrend, menunev, tartalom, statusz
                    FROM cms_tartalom
                    ORDER BY sorrend ASC";

$eredmeny   =       mysqli_query($dbconn, $sql);


$tablazat   =  "<p><a href=\"tartalom-letrehozas.php\"><span class=\"material-symbols-outlined\">add_box</span>Uj oldal letrehozas</a></p>";

$tablazat  .= "<table>\n";

$tablazat .= "<tr>
                <th>Allias</th>
                <th>No.</th>
                <th>Menunev</th>
                <th>Tartalom</th>
                <th>Statusz</th>
                <th>Muvelet</th>
            </tr>\n";

while ($sor = mysqli_fetch_assoc($eredmeny)) {
    $tablazat .= "<tr>
                    <td>{$sor['allias']}</td>
                    <td>{$sor['sorrend']}</td>
                    <td>{$sor['menunev']}</td>
                    <td>" . substr(strip_tags($sor['tartalom']), 0, 100) . "</td> 
                    <td>{$sor['statusz']}</td>
                    <td><a href=\"tartalom-modositas.php?id={$sor['id']}\"><span class=\"material-symbols-outlined\">edit</span></a>
                    <a href=\"tartalom-torles.php?id={$sor['id']}\"><span class=\"material-symbols-outlined\" onclick=\"return confirm('Biztos benne?')\">delete</span></a></td>       
                </tr>\n";
}

$tablazat  .= "</table>\n";

$tablazat  .=  "<p><a href=\"tartalom-letrehozas.php\"><span class=\"material-symbols-outlined\">add_box</span>Uj oldal letrehozas</a></p>";

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
