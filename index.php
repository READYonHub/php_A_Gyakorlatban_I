<?php
require_once("adatbazis.php");

/* Menu osszeallitasa */

$sql            =  "SELECT id, allias, menunev, 
                    FROM cms_tartalom
                    WHERE statusz = 1
                    ORDER BY sorrend ASC";

$menu           =   "<ul>
                        <li><a href=\"#\" class=\"aktiv\">Bemutatkozás</a></li>
                        <li><a href=\"#\">Kedvencek</a></li>
                        <li><a href=\"#\">Képgaléria</a></li>
                        <li><a href=\"#\">Kapcsolat</a></li>
                    </ul>";

/* Tartalom elkeszitese */

$sql            =  "SELECT menunev, tartalom, modositas, leiras, kulcsszavak
                    FROM cms_tartalom
                    WHERE id = " . $id . "
                    LIMIT 1";

$leiras         =   $sor['leiras'];
$kulcsszavak    =   $sor['kulcsszavak'];
$menunev        =   $sor['menunev'];
$tartalom       =   $sor['tartalom'];

/* Modulok kezelese */
$oldalsav       =   "";

/* Sablonozo */
$sablon = file_get_contents("sablon.html"); //print file_get_contents gyakorlatilag csak átjátszóként beszippant egy fájlt
$sablon = str_replace("{{leiras}}",         $leiras,        $sablon);
$sablon = str_replace("{{kulcsszavak}}",    $kulcsszavak,   $sablon);
$sablon = str_replace("{{menunev}}",        $menunev,       $sablon);
$sablon = str_replace("{{menu}}",           $menu,          $sablon);
$sablon = str_replace("{{tartalom}}",       $tartalom,      $sablon);
$sablon = str_replace("{{oldalsav}}",       $oldalsav,      $sablon);
print $sablon;
